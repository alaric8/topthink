<?php  
declare (strict_types = 1);
namespace app\common\model\user;
use think\Model;

class Label extends Model
{
    protected $autoWriteTimestamp = true;
    protected  $table ="user_label";
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
}
