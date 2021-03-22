<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function getStates()
    {
        return $this->belongsTo(State::class, 'country_id');
    }
}
