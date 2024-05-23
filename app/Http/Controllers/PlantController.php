<?php

namespace App\Http\Controllers;

use App\Http\Resources\Error\WrongDataResponseResource;
use App\Http\Resources\Plant\PlantRequestResource;
use App\Http\Resources\Success\SuccessResponseResource;
use Illuminate\Http\Request;
use App\Models\Plant;

class PlantController extends Controller
{
    protected $plant;

    public function __construct(Plant $plant)
    {
        $this->plant = $plant;
    }

    public function index()
    {
        $plants = Plant::all();
        return PlantRequestResource::collection($plants);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'required|string|max:255',
            'money' => 'required',
        ]);

        try {
            // $transaction = $this->plant->addPlant($request->name, $request->species, $request->datePlanted);
            $transaction = 'id transaction';
            // $plant = Plant::create($request->all());
            Plant::create([
                'name' => $request->name,
                'notes' => $request->notes,
                'money' => $request->money,
            ]);
            //     return response()->json(['message' => 'Plant added successfully', 'transaction' => $transaction], 201);
            // } catch (\Exception $e) {
            //     return response()->json(['error' => $e->getMessage()], 500);
            // }
            return new SuccessResponseResource(['message' => 'Растение добавлено']);
        } catch (\Throwable $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function show(Plant $id)
    {
        try {
            // $plant = Plant::findOrFail($id);
            // $contractPlant = $this->plant->getPlant($id);
            $contractPlant = 'id contractPlant';
            return new PlantRequestResource($id);
            // return response()->json(['plant' => $plant, 'contract_plant' => $contractPlant], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Plant $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'notes' => 'required|string|max:255',
            'money' => 'required',
        ]);

        try {
            // $plant = Plant::findOrFail($id);
            $id->update($request->all());
            // return response()->json($plant);
            return new SuccessResponseResource(['message' => 'Изменения приняты']);
        } catch (\Exception $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function destroy(Plant $id)
    {
        try {
            // $plant = Plant::findOrFail($id);
            $id->delete();
            return new SuccessResponseResource(['message' => 'Растение удалено']);
        } catch (\Exception $th) {
            return new WrongDataResponseResource(['message' => $th->getMessage()]);
        }
    }

    public function purchasePlant(Request $request)
    {
        $request->validate([
            'plantId' => 'required|integer',
            'quantity' => 'required|integer',
            'money' => 'required',
        ]);

        try {
            // $transaction = $this->plant->purchasePlant($request->plantId, $request->quantity, $request->money);
            $transaction = 'id transaction';
            return response()->json(['message' => 'Plant purchased successfully', 'transaction' => $transaction], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
