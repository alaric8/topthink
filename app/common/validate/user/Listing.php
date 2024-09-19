<?php
declare(strict_types=1);

namespace app\common\validate\user;

use app\common\model\user\User;
use think\validate;

class Listing extends validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [
        "account" => ['require'],
        "password" => ['require'],
    ];
    protected $field =[
        "account"=>"账户"
    ];
    protected $message = [
        "account.exists"=>"账户不存在",
        "password.confirm"=>"两次密码不一致",
    ];
    /**
     * 创建场景
     */
    public function sceneCreate()
    {
        return $this->only(['password', 'account'])
        ->append('account', ['unique' => ['user', 'account']])
        ->append("password","confirm");
    }

    /**
     * 编辑场景
     */
    public function sceneEdit()
    {
        $id = request()->param(('id'));
        return $this->only(['account','password'])
            ->append('account', "unique:user,account,$id")
            ->remove("password","require")
            ->append("password","confirm");
    }

    

    protected function exists($value, $rule, $data=[],$field,$message)
    {   
        
         if(is_string($rule)){
            $rule = explode(',',$rule);
         }
         $result  = User::where($field,$value)->cache(true,60)->find();
         if(!$result){
            return  ":attribute 不存在·";
         }
         return true;
    }
    
    protected function password($value,$rule,$data){
          $user =  User::where("account",$data['account'])
                       ->cache(true,60)
                       ->find();
          $password_confirm = (new User())->setPasswordAttr($value);
          if($user['password']!== $password_confirm){
                return "密码错误";
          }
          return true;
    }
    public function sceneLogin(){
        return $this->only(['account','password'])
            ->append('account','exists:user,account')
            ->append("password","password");
    } 
}
