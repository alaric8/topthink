<?php
declare(strict_types=1);

namespace app\common\validate\system;

use think\validate;

class Menu extends validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     * @var array
     */
    protected $rule = [
        "title|菜单名称"=> ["require"],
        "parent_id|上级"=> ['require','number'],
        "route_path|路由"=>['require']
    ];
    protected $message = [
        "title.require"=>":attribute 不能为空",
        'parent_id.notIn'=> '不能选择自己为父菜单'
    ];
    /**
     * 创建场景
     */
    public function sceneCreate()
    {
        return $this->only([
            'title',
            "parent_id",
            "route_path",
            "icon"
        ]);
    }

    /**
     * 编辑场景
     */
    public function sceneEdit()
    {
        $id = request()->param("id");
        return $this->only([
            "title",
            "parent_id"
        ])
        ->append("parent_id",['notIn'=>"$id"]);
    }
    
}
