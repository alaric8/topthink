<?php
declare(strict_types=1);

namespace app\common\validate\system;

use think\validate;

class Role extends validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [
        "name|名称"=>['require'],
        "system_menu_ids"=>['require','array']
    ];
    protected $message = [
        // "name.require"=>":attribute 不能为空"
    ];
    /**
     * 创建场景
     */
    public function sceneCreate()
    {
        return $this->only(['name','system_menu_ids']);
    }

    /**
     * 编辑场景
     */
    public function sceneEdit()
    {
        return $this->only(['name','system_menu_ids']);
    }
    
}
