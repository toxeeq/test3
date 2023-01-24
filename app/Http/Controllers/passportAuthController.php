<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class passportAuthController extends Controller
{
    public function newUserRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>bcrypt($request->password)
        ]);

        $accsessToken = $user->createToken('passwordExam')->accessToken;

        return response()->json(['token' => $accsessToken], 200);
    }

    public function loginUser(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(!(auth()->attempt($login)))
        {

            $userToken = auth()->user()->createToken('passwordExam')->accsesToken;

            return response()->json(['token' => $userToken], 200);
        }

        return response()->json(['error' => 'Bezan be chak'], 200);
    }

    public function userDetaile()
    {
        return response()->json(['detaile'=> auth()->user()], 200);
    }
}
