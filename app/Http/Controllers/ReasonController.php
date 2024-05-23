<?php

namespace App\Http\Controllers;

use App\Http\Resources\Error\WrongDataResponseResource;
use App\Http\Resources\Reason\ReasonRequestResource;
use App\Http\Resources\Success\SuccessResponseResource;
use App\Models\Reason;
use Illuminate\Http\Request;

class ReasonController extends Controller
{
    public function index()
    {
        $reasons = Reason::all();
        return ReasonRequestResource::collection($reasons);
    }

    public function store(Request $request)
    {
        try {
            Reason::create([
                'name_reason' => $request->name_reason
            ]);
            return new SuccessResponseResource(['message' => 'Причина успешно создана']);
        } catch (\Throwable $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function show(Reason $id)
    {
        return new ReasonRequestResource($id);
    }

    public function update(Request $request, Reason $id)
    {
        try {
            $id->update($request->all());
            return new SuccessResponseResource(['message' => 'Причина успешно обновлена']);
        } catch (\Throwable $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function destroy(Reason $id)
    {
        try {
            $id->delete();
            return new SuccessResponseResource(['message' => 'Причина успешно удалена']);
        } catch (\Throwable $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }
}
