<?php

namespace App\Http\Controllers;

use App\Http\Resources\Error\WrongDataResponseResource;
use App\Http\Resources\Investition\InvestitionsResponseResource;
use App\Http\Resources\Success\SuccessResponseResource;
use App\Http\Resources\WorkMoney\WorkMoneyRequestResource;
use App\Models\UserMoney;
use App\Models\WorkWithMoney;
use Illuminate\Http\Request;

class WorkWithMoneyController extends Controller
{
    public function index()
    {
        $workWithMoneys = WorkWithMoney::with(['reason', 'user'])->get();
        return WorkMoneyRequestResource::collection($workWithMoneys);
    }

    public function invest_index()
    {
        $all_investitions = UserMoney::where('money_give', 0)->with(['ho_invest'])->get();
        return InvestitionsResponseResource::collection($all_investitions);
    }

    public function store(Request $request)
    {
        try {
            WorkWithMoney::create([
                'id_reason' => $request->id_reason,
                'id_user' => $request->id_user,
                'money' => $request->money,
                'numberdoc' => $request->numberdoc
            ]);

            $user_money = UserMoney::findOrFail($request->id_user);
            $user_money->update([
                'money_give' => 1
            ]);
            return new SuccessResponseResource(['message' => 'Денежные средаства приняты']);
        } catch (\Exception $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function show($id)
    {
        $workWithMoney = WorkWithMoney::with(['reason', 'user'])->findOrFail($id);
        return WorkMoneyRequestResource::collection($workWithMoney);
    }
}
