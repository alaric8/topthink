<?php

namespace app\common\model\order;

use app\common\model\game\Rule;
use think\model\Pivot;

class OrderDetail extends  Pivot{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    public function Rule(){
      return $this->belongsTo(Rule::class);
    } 
}