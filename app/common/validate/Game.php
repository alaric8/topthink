<?php
declare (strict_types = 1);
namespace app\common\validate;
use think\Validate;
use think\facade\Db;
class Game extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        "name|游戏名称"=>["require"],
        "background_image|背景图片"=>['require']
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     * @var array
     */
    protected $message = [
        "game_id.require"=>['code'=>400,'error_code'=>4001, 'msg'=>"请选择一个游戏！"]
    ];
   // 自定义验证规则
   protected function exist($value, $rule, $data=[],$field)
   {
        $result = Db::table($rule['table'])->find($value);
        if(!$result){
           return  "$field 不是一个有效的值";
        }
        return true;
   }    
   public function sceneCreate(){
        return $this->only(["name"]);
   }
    public function sceneBetting(){
         return $this->only(['game_id']);
    }
}
