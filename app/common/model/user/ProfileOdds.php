<?php

namespace app\common\model\user;

use think\model\Pivot;
use app\common\model\game\Rule;
use app\common\model\game\Game;

class ProfileOdds extends Pivot{
    protected $table="user_profile_odds";
    public function Rule(){
        return $this->belongsTo(Rule::class);
    }
    public function Game(){
        return $this->belongsTo(Game::class);
    } 
}