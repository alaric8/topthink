<?php  


declare (strict_types = 1);
namespace app\common\model\lottery;
use think\Model;

class LotteryType extends Model
{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $readonly = ['created_at','updated_at'];
    protected $json =[
        "ball"
    ];
    protected $jsonAssoc = true;
}