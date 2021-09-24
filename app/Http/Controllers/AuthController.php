<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\user;
class AuthController extends Controller
{
    public function login(Request $request)
    {

      // return response()->json([
      //   'status_code' => 500,
      //   'message' => $request->a
      // ]);
      try {
        $request->validate([
          'username' => 'required',
          'password' => 'required'
        ]);
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (!Auth::attempt($credentials)) {
          return response()->json([
            'status_code' => 500,
            'message' => 'Unauthorized'
          ]);
        }
        $user = User::where('username', $request->username)->first();
        if ( ! Hash::check($request->password, $user->password, [])) {
           throw new \Exception('Error in Login');
        }
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
          'status_code' => 200,
          'access_token' => $tokenResult,
          'token_type' => 'Bearer',
        ]);
      } catch (Exception $error) {
        return response()->json([
          'status_code' => 500,
          'message' => 'Error in Login',
          'error' => $error,
        ]);
      }
    }
}
