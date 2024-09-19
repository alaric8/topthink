<?php  


declare (strict_types = 1);
namespace app\common\model\system;
use think\Model;

class SystemMenu extends Model
{
    protected $autoWriteTimestamp = true;
    protected $append = [
    
        "has_children"
       
    ];
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    public function getHasChildrenAttr(){
        $has_children =  self::where("parent_id",$this->id)->find();
        return  $has_children  ?  true : false;
        
    }
    
    
}
