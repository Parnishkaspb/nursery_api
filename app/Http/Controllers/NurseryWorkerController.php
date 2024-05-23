<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\Worker\RegisterWorkerRequest;
use App\Http\Resources\Error\IncorrectResponseResource;
use App\Http\Resources\Error\WrongDataResponseResource;
use App\Http\Resources\Success\SuccessResponseResource;
use App\Http\Resources\Worker\LoginResponseResource;
use App\Models\NurseryWorker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NurseryWorkerController extends Controller
{
    public function login(LoginRequest $request)
    {
        $worker = Auth::guard('workers')->getProvider()->retrieveByCredentials($request->only('login', 'password'));

        if ($worker && Auth::guard('workers')->getProvider()->validateCredentials($worker, $request->only('password'))) {
            $token = $worker->createToken('workerToken')->plainTextToken;
            return new LoginResponseResource(['token' => $token, 'role' => $worker->id_role, 'name' => $worker->name]);
        }
        return new IncorrectResponseResource(['message' => 'Неверные учетные данные.']);
    }


    public function store(RegisterWorkerRequest $request)
    { {
            try {
                NurseryWorker::create([
                    'login' => e($request->login),
                    'name' => e($request->name),
                    'surname' => e($request->surname),
                    'telephone' => $request->telephone,
                    'password' => $request->password,
                    'id_role' => $request->id_role
                ]);

                return new SuccessResponseResource(['message' => 'Сотрудник успешно создан']);
            } catch (\Throwable $th) {
                return new WrongDataResponseResource(['message' => $th->getMessage()]);
            }
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return new SuccessResponseResource(['message' => 'Вы успешно вышли из системы']);
    }
}
