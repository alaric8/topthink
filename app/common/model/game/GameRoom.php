<?php  
declare (strict_types = 1);
namespace app\common\model\game;
use think\model\Pivot;

class GameRoom extends Pivot
{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    public function Game(){
        return $this->belongsTo(Game::class);
    }
}

