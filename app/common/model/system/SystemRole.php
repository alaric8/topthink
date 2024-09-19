<?php  


declare (strict_types = 1);
namespace app\common\model\system;
use think\Model;

class SystemRole extends Model
{
    protected $autoWriteTimestamp = true;
    protected $append = [
       
    ];
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $json= ["system_menu_ids"];
    protected $jsonAssoc = true;
       
        
    
       
        
    
       
        
     
    
   
    
}
