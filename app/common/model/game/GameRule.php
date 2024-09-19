<?php  
declare (strict_types = 1);
namespace app\common\model\game;
use think\model\Pivot;

class GameRule extends Pivot
{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    
}
