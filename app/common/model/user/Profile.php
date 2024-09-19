<?php

namespace app\common\model\user;

use app\common\model\game\Game;
use app\common\model\game\GameRoom;
use app\common\model\Room;
use think\Model;

class  Profile extends  Model{
    protected $append = ['status_msg'];
    protected $table="user_profile";

    /**
     * 房间
     * @return \think\model\relation\BelongsTo
     */
    public function Room(){
        return $this->belongsTo(Room::class)->hidden(['created_at','updated_at','game_ids']);
    }
   
    /**
     * 账户
     * @return \think\model\relation\BelongsTo
     */
    public function User(){
        return $this->belongsTo(User::class);
    }

    /**
     * 游戏
     * @return \think\model\relation\HasManyThrough
     */
    public function game()
    {
        // Through the game_room table
        return $this->hasManyThrough(Game::class, GameRoom::class, 'room_id', 'id', 'room_id', 'game_id');
    }

    /**
     * 状态信息
     * @param $value
     * @return mixed
     */
    public function getStatusMsgAttr($value){
       return  $this->status;
    }
}
