<?php  


declare (strict_types = 1);
namespace app\common\model\lottery;
use app\common\model\game\Game;
use think\Model;

class LotteryDraw extends Model
{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';

    public function Game()
    {
        return $this->hasOne(Game::class,"id",'game_id');
    }
    public function LotteryType(){
        return $this->belongsTo(LotteryType::class)->bind(['type_name'=>'name']);
    }
    
    public function  getBallAttr($value){
        return explode(',',$value);
    }
}
