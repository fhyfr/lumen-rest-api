<?php

namespace App\Http\Controllers;

use Crypt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // register
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password'=> 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $hashPassword = Hash::make($password);
        
        $user = User::create([
            'email'=> $email,
            'password' => $hashPassword
        ]);

        return response()->json(['status' => 200, 'message' => 'User has been created!'], 201);
   }

   // login
   public function login(Request $request)
   {
        $this->validate($request, [
            'email' => 'required|email',
            'password'=> 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        if(!$user){
            return response()->json(['status' => 404, 'message' => 'User not found!'], 404);
        }

        $validPassword = Hash::check($password, $user->password);
        if(!$validPassword){
            return response()->json(['message' => 'login failed!']);
        }
        
        $generateToken = bin2hex(random_bytes(40));
        $user->update([
            'token' => $generateToken
        ]);

        return response()->json($user);
   }

}
