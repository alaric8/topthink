<?php
declare(strict_types=1);

namespace app\common\validate\system;

use think\validate;

class User extends validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [
        "name" => ['require'],
        "account" => ['require'],
        "sex" => ['require'],
        "password" => ['require', 'confirm'],
    ];

    /**
     * 创建场景
     */
    public function sceneCreate()
    {
        return $this->only(["name", 'password', 'account', 'sex'])
            ->append('account', ['unique' => ['system_user', 'account']]);
    }

    /**
     * 编辑场景
     */
    public function sceneEdit()
    {
        $id = request()->param(('id'));
        return $this->only(['name','account', 'sex'])
            ->append('account', "unique:system_user,account,$id");
    }
    /**
     * 密码变更场景
     */
    public function sceneChange()
    {
        return $this->only(['password']);
    }
}
