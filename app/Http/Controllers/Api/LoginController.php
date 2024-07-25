<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Validator;
use Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request){
    if (!auth()->attempt($request->only('email', 'password'))){
        return response()->json([
            'status' => false,
            'message' => 'Gagal login',
        ], 401);
    }
    $user = User::where('email', $request->email)->firstOrFail();
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status' => true,
        'data' => $user,
        'access_token' =>$token,
        'message' => 'Login success',
    ], 200);
}

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
        'status' => true,
        'message' => 'logout berhasil',
        ], 200);
    }
    public function register(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255 |unique:users',
            'password' => 'required|string|max:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $user = User::create ([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request ->password),
        ]);
        return response()-> json([
            'data' => $user,
            'success' => true,
            'message' => 'user berhasil dibuat',

        ]);
    }

}
