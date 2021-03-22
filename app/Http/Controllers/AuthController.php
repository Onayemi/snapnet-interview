<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api'); //, ['except' => ['login', 'register']]
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $token_validity = 24 * 60;
        Auth::factory()->setTTL($token_validity);
        // if(!$token = JWTAuth::attempt($validator->validated())){}
        if(!$token = Auth::attempt($validator->validated())){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'data' => auth()->user()
        ]);
    }


    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $addUser = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $addUser
        ], 201);

    }

    public function editUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $updateUser = User::where('id', $request->id)->update([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);
        if($updateUser){
            return response()->json(['message' => 'Update success']);
        }
        return response()->json(['error' => 'Could not update users records'], 401);
    }

    public function logout(){
        Auth::logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function profile(){
        return response()->json(['user' =>auth()->user()]);
    }

    public function refresh(){
        return $this->createNewToken(Auth::refresh());
        // return $this->createNewToken(auth()->refresh());
    }

    public function guard(){
        return Auth::guard();
    }
}
