<?php  


declare (strict_types = 1);
namespace app\common\model\system;
use GatewayWorker\Lib\Gateway;
use think\Model;

class SystemUser extends Model
{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $hidden = ["password"];

    protected $append = [
        "is_online"
    ];
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    public function setPasswordAttr($value){
        return md5($value);
    }

    public function getIsOnlineAttr(){
        return  Gateway::isUidOnline($this->id);
    }
    public function SystemRole()
    {
        return $this->hasOne(SystemRole::class,"id",'system_role_id');
    }
    
    
}
