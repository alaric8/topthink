<?php

namespace app\common\model;

use app\common\model\game\Game;
use app\common\model\game\GameRoom;
use app\common\model\user\User;
use think\Model;

class  Room extends  Model{
    protected $json= ["game_ids"];
    protected $jsonAssoc = true; 
    public function Game(){
        return $this->belongsToMany(Game::class, GameRoom::class);
    }
    
    public function Admin(){
        return $this->belongsTo(User::class,'admin_id')->bind(['account'=>"account",'avatar'=>"avatar"]);
    }

       // 删除用户时删除中间表数据
    public static function onBeforeDelete($Room)
    {
        $Room->Game()->detach(); 
    }
   
}