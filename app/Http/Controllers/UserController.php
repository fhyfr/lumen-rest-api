<?php

namespace App\Http\Controllers;

use Crypt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
}
