<?php  
declare (strict_types = 1);
namespace app\common\model\game;
use think\model\Pivot;

class Rule extends Pivot
{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $json= ["rules"];
    protected $jsonAssoc = true;
    public function RuleValue()
    {
        return $this->hasMany(RuleValue::class);
    }
    public function Game(){
        return $this->belongsTo(Game::class);
    }
    // 删除前
    public static  function onBeforeDelete($rule){
        $rule->RuleValue()->delete(); 
        $rule->Game()->detach();  
    }
    public static function onAfterInsert($rule)
    {
        $rule_value = request()->post("rule_value");
        $data =  array_map(function($data) {
                $field= ['unique_key','value'];
                return  array_intersect_key($data,array_flip($field));
         },$rule_value);
         $rule->RuleValue()->saveAll($data);
    }
    public static function onBeforeUpdate($rule)
    {
        $rule_value = request()->post("rule_value");
        $data =  array_map(function($data) {
                $field= ['id','unique_key','value'];
                return  array_intersect_key($data,array_flip($field));
         },$rule_value);
        $rule->RuleValue()->saveAll($data);
    }
}
