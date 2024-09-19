<?php

namespace app\common\model\order;

use app\common\model\game\Game;
use app\common\model\game\RuleValue;
use app\common\model\Room;
use app\common\model\user\User;
use think\Model;

class Order extends  Model{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    public function Room(){
        return $this->belongsTo(Room::class);
    }

    
    public function Detail()
    {
        return $this->belongsToMany(RuleValue::class, OrderDetail::class);
    }
    public function Game(){
       return $this->belongsTo(Game::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}