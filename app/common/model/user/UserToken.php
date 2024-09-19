<?php  
declare (strict_types = 1);
namespace app\common\model\user;
use think\Model;

class UserToken extends Model
{
    // 开启自动写入时间戳
    protected $autoWriteTimestamp = true;
    // 自定义时间戳字段
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $append = ['expired'];
    public static function onBeforeInsert($userToken)
    {
        $userToken->token = md5(sha1(uniqid(sprintf('a%s',mt_rand()), true)));
        $userToken->expired_time = time() + 3600;
    }
    public function getExpiredAttr(){
        return $this->expired_time <= time();
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}
