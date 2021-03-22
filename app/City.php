<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function getStates(){
        return $this->hasMany(State::class, 'state_id', 'id');
    }
}
