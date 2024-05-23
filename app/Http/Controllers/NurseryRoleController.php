<?php

namespace App\Http\Controllers;

use App\Http\Resources\Error\WrongDataResponseResource;
use App\Http\Resources\Role\RoleRequestResource;
use App\Http\Resources\Success\SuccessResponseResource;
use App\Models\NurseryRole;
use Illuminate\Http\Request;

class NurseryRoleController extends Controller
{
    public function index()
    {
        $roles = NurseryRole::all();
        return RoleRequestResource::collection($roles);
    }

    public function store(Request $request)
    {
        try {
            NurseryRole::create([
                'name_role' => $request->name_role
            ]);
            return new SuccessResponseResource(['message' => 'Должность успешно создана']);
        } catch (\Throwable $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function update(Request $request, NurseryRole $id)
    {
        try {
            $id->update($request->all());
            return new SuccessResponseResource(['message' => 'Изменения приняты']);
        } catch (\Exception $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function destroy(NurseryRole $id)
    {
        try {
            $id->delete();
            return new SuccessResponseResource(['message' => 'Должность удалена']);
        } catch (\Exception $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }
}
