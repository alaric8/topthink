<?php  
declare (strict_types = 1);
namespace app\common\model\user;
use app\common\model\game\GameRoom;
use think\Model;

class User extends Model
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $hidden = ["password"];
    protected $append = [
        // "is_online"
    ];
    
    public function getIsOnlineAttr(){
        return  $this->id;
    }
    public function GameRoom(){
        return $this->belongsTo(GameRoom::class,'room_id');
    }
    public function Token(){
        return $this->hasOne(UserToken::class);
    }
    /**
     *  加密密码
     */
    public function setPasswordAttr($value){
        return md5($value);
    }
}
