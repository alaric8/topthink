<?php  
declare (strict_types = 1);
namespace app\common\model\game;
use app\common\model\lottery\LotteryType;
use app\common\model\Room;
use think\facade\Cache;
use think\Model;

class Game extends Model
{
    const STATUS = [
        '0' => '关闭',
        '1' => '启用',
        '2' => '封盘中',
    ];
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $json =['rule_ids'];
    // protected $append = ['next_issue_time','prev_code','issue','draw_status'];
    protected $append =[
       "status_message"  
    ];
    protected $jsonAssoc = true;
    
    public function getStatusMessageAttr(){
        return self::STATUS[$this->status];
    }
    public function getDrawStatusAttr(){
        
        $draw = Cache::get($this->lot_code);
        if(!$draw){
            return false;
        }
        $second =  strtotime($draw['next_draw_time']) - time();
        if($second  <= 0){
            return 0;
        } 
        return 1;
    }
    public function getNextIssueTimeAttr(){
        $draw = Cache::get($this->lot_code);
        if(!$draw){
            return 0;
        }
        $second =  strtotime($draw['next_draw_time']) - time();
        if($second  <= 0){
            return 2;
        }
        return  $second;
    }
    public function getPrevCodeAttr(){
        $draw = Cache::get($this->lot_code);
        if(!$draw){
            return [];
        }
        $ball = explode(',', $draw['ball']);
        return $ball;
    }
    public function getIssueAttr(){
        $draw = Cache::get($this->lot_code);
        if(!$draw){
            return 0;
        }
        return  $draw['issue'];
    }
    public function LotteryType(){
        return $this->belongsTo(LotteryType::class);
    }
    public function Rule(){
        return $this->belongsToMany(Rule::class, GameRule::class);
    }
    public function Room(){
        return $this->belongsToMany(Room::class, GameRoom::class);
    }
     // 删除用户时删除中间表数据
     public static function onBeforeDelete($game)
     {
        $game->Rule()->detach(); 
        $game->Room()->detach();  
         // 删除关联数据
     }
}
