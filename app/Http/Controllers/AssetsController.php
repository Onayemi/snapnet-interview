<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Assets;
use App\User;

class AssetsController extends Controller
{
    public function login(){
        return view('admin.read');
    }

    public function index(){
        $result = Assets::where('user_id', Auth::user()->id)->get();
        return view('admin.read', ['res'=>$result]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'investment_type' => 'required|string',
            'company_name' => 'required|string',
            'company_email' => 'required|string',
            'company_email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $result = User::where('id', Auth::user()->id)->first();
        $insertAssets = Assets::create([
            'user_id' => $result->id,
            'type' => $request->type,
            'investment_type' => $request->investment_type,
            'company_name' => $request->company_name,
            'company_name' => $request->company_email,
            'company_name' =>  $request->company_phone
        ]);
        return view('admin.read', ['res'=>$insertAssets]);
    }
}
