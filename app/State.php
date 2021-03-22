<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = [];

    public function getCountries(){
        return $this->hasMany(Country::class, 'Country_id');
    }

    public function getCities()
    {
        return $this->belongsTo(City::class, 'state_id', 'id');
    }
}
