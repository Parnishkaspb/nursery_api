<?php

namespace App\Http\Controllers;




use App\Models\User;
use Illuminate\Support\Facades\{Auth, Request};
use App\Http\Requests\User\{LoginRequest, RegisterRequest};

use App\Http\Resources\Error\{WrongDataResponseResource, IncorrectResponseResource};
use App\Http\Resources\User\LoginResponseResource;
use App\Http\Resources\Success\SuccessResponseResource;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('userToken', ['*'])->plainTextToken;

            return new LoginResponseResource(['token' => $token]);
        }

        return new IncorrectResponseResource(['message' => 'Неверные учетные данные.']);
    }

    public function store(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'login' => $request->login,
                'password' => $request->password,
                'name' => $request->name,
                'email' => $request->email,
                'surname' => $request->surname,
                'telephone' => $request->telephone,
            ]);

            $token = $user->createToken('userToken')->plainTextToken;
            return new LoginResponseResource(['token' => $token]);
        } catch (\Throwable $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return new SuccessResponseResource(['message' => 'Вы успешно вышли из системы']);
    }
}
