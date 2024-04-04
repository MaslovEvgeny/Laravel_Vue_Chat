<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        $user = User::where('email', $request->email)->orWhere('login', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'error' => 'Неверный логин или пароль!',
            ]);
        }

        return response()->json(['token' => $user->createToken($request->email)->plainTextToken]);

    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['msg' => 'Logout Successfull']);
    }
}
