<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function createEquipment(Request $request){
        $validated= $request->validate([
            'name' => 'required|string:equipments,name',
            'usage'=>'required|string',
            'model_no'=>'required|string',
            'value'=>'required|string',
            'status'=>'required|string',
        ]);
        $equipment=new Equipment();
        $equipment->name = $validated['name'];
        $equipment->usage = $validated['usage'];
        $equipment->model_no = $validated['model_no'];
        $equipment->value = $validated['value'];
        $equipment->status = $validated['status'];
        try {
            $equipment->save();
            return response()->json($equipment);
        }
        catch (\Exception $e){
            return response()->json([
                'error' =>"Failed to create equipment",
                'message'=> $e->getMessage()
            ]);
        }
    }
    public function readAllEquipments(){
        try{
            $equipments = Equipment::all();
            return response()->json($equipments);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch equipment",
                'message'=> $exception->getMessage()
            ], 500);
        }
    }
    public function readEquipment($id){
        try{
            $equipment= Equipment::findOrfail($id);
            return response()->json($equipment);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch equipment",
                'message'=> $exception->getMessage()
            ], 500);
         }

    }
    public function updateEquipment(Request $request,$id){
         $validated= $request->validate([
            'name' => 'required|string:equipments,name',
            'usage'=>'required|string',
            'model_no'=>'required|string',
            'value'=>'required|string',
            'status'=>'required|string',
         ]);
        try{
        $equipment=new Equipment();
        $equipment->name = $validated['name'];
        $equipment->usage = $validated['usage'];
        $equipment->model_no = $validated['model_no'];
        $equipment->value = $validated['value'];
        $equipment->status = $validated['status'];
             return response()->json($equipment);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch equipment",
                'message'=> $exception->getMessage()
            ], 500);
         }        
    }
    public function deleteEquipment($id){
        try{
            $equipment =Equipment::findOrFail($id);
            $equipment->delete();
            return response('Equipment Deleted Successfully!');
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch equipment",
                'message'=> $exception->getMessage()
            ], 500);
        
    }
}
}
