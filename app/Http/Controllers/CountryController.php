<?php

namespace App\Http\Controllers;

// use App\User;
use App\Country;
use App\State;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index(){
        $result = Country::all();
        if($result){
            return response()->json([
                'message' => 'success',
                'Country_details' => $result
            ], 201);   
        }
    }

    public function getStateCountry(){
        $country = DB::table('countries')->join('states', 'countries.id', '=', 'states.country_id')->join('cities', 'states.id', '=', 'cities.state_id')->get();
        if($country){
            return response()->json(['message' => 'success', 'details' => $country], 201);   
        }
    }
    
}
