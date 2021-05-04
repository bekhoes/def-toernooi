<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    
    protected $with = ['players', 'raids'];

    public function players () {
        return $this->hasMany(Player::class);
    }
    public function raids () {
        return $this->hasMany(Raid::class);
    }
}
