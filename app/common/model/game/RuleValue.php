<?php
declare(strict_types=1);
namespace app\common\model\game;
use think\Model;

class RuleValue extends Model
{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $append = ['odds'];
    public function Rule()
    {
        return $this->belongsTo(Rule::class);
    }
    

}