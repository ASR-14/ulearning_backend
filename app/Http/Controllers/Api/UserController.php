<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Userland;

// class LoginController extends Controller
// {
//     //
// }
class UserController extends Controller
{


// class LoginController extends Controller{
    public function createUser(Request $request)
    {

        
        try{
            $validateUser = Validator::make($request->all(),
            [
                'avatar' =>'required',
                'type'=> 'required',
                'open_id'=> 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                // 'password' => 'required',
            ]);
            if ($validateUser -> fails()) {
                return response()->json(
                    [
                        'status'=> false,
                        'message' => 'validation error',
                        'errors' => $validateUser->errors()
                    ], 401);
                }

            $validated = $validateUser->validate();
            $map = [] ;
            $map['type'] = $validated['type'];
            $map['open_id'] = $validated['open_id'];

            $user = User::where($map)->first();

            $user = User::create([
                'name' => $request ->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status'=> true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);

            
            
        }catch(\Throwable $th){
            return response()->json([
                'status'=> false,
                'message' => $th->getMessage()
            ], 500);
        }


    }


    public function loginUser(Request $request){
        try {
            $validateUser = Validator::make($request->all(),[
                'email' => 'required|email',
                'password'=> 'required'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status'=> false,
                    'message'=> 'validation error',
                    'error'=> $validateUser->errors()
                ],401);
            }

            if (!Auth::attempt($request->only(['email','password']))) {
                return response()->json([
                    'status'=> false,
                    'message'=> 'Email & Password does not math with our record.',
                ],401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status'=> true,
                'message'=> 'User Logged In Successfully',
                'token'=> $user->createToken('APT TOKEN')->plainTextToken
            ],200);
            




        } catch (\Throwable $th) {
            return response()->json([
                'status'=> false,
                'message'=> $th->getMessage()
            ],500);
        }
    }

}