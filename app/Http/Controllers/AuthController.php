<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'usuario creado',
                'token' => $request->user()->createToken($request->email)
                    ->plainTextToken,
            ]);
        }
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Datos Incorrectos ',
                'success' => false
            ], 200);
        }

        $userToken = User::where('name', $request->email)->first();
        if ($userToken) {
            $userToken->delete();
        }
        return response()->json([
            'success' => true,
            'token' => $request->user()->createToken($request->email)->plainTextToken,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Token eliminado correctamente',
        ], 410);
    }
}
