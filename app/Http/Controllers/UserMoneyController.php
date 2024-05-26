<?php

namespace App\Http\Controllers;

use App\Http\Requests\Investition\CreateInvestitionRequest;
use App\Http\Resources\Error\WrongDataResponseResource;
use App\Http\Resources\Investition\InvestitionResponseResource;
use App\Http\Resources\Success\SuccessResponseResource;
use App\Models\UserMoney;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMoneyController extends Controller
{
    public function all()
    {
        $user = Auth::user();
        $all_investitions = $user->moneys;
        return InvestitionResponseResource::collection($all_investitions);
    }

    public function store(CreateInvestitionRequest $request)
    {
        $user = Auth::user();
        try {
            $user = UserMoney::create([

                'id_user' => $user->id,
                'summa' => $request->summa,
                'money_give' => 0,
                'percent' => $request->percent,
                'years' => $request->years,
            ]);

            return new SuccessResponseResource(['message' => 'Инвестиция создана']);
        } catch (\Throwable $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function show(UserMoney $id)
    {
        $this->authorize('view', $id);

        try {
            return new InvestitionResponseResource($id);
        } catch (\Throwable $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }

    }

    public function destroy(UserMoney $id)
    {
        $this->authorize('delete', $id);

        try {
            $id->delete();
            return new SuccessResponseResource(['message' => 'Удаление произошло успешно']);
        } catch (\Throwable $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }

    }
}
