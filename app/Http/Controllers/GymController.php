<?php

namespace App\Http\Controllers;

use App\Models\gym;
use Illuminate\Http\Request;

class gymController extends Controller
{
    public function creategym(Request $request){
        $validated= $request->validate([
            'name' => 'required|string:gyms,name',
            'longitude'=>'required|string',
            'latitude'=>'required|string',
            'description' =>'string|max:1000',
        ]);
        $gym=new gym();
        $gym->name = $validated['name'];
        $gym->longitude = $validated['name'];
        $gym->latitude = $validated['name'];
        $gym->description = $validated['description'];
        try {
            $gym->save();
            return response()->json($gym);
        }
        catch (\Exception $e){
            return response()->json([
                'error' =>"Failed to create gym",
                'message'=> $e->getMessage()
            ]);
        }
    }
    public function readAllgyms(){
        try{
            $gyms = gym::all();
            return response()->json($gyms);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch gym",
                'message'=> $exception->getMessage()
            ], 500);
        }
    }
    public function readgym($id){
        try{
            $gym= gym::findOrfail($id);
            return response()->json($gym);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch gym",
                'message'=> $exception->getMessage()
            ], 500);
         }

    }
    public function updategym(Request $request,$id){
         $validated= $request->validate([
            'name' => 'required|string:gyms,name',
            'longitude'=>'required|string',
            'latitude'=>'required|string',
            'description' =>'string|max:1000',
         ]);
        try{
             $gym= gym::findOrfail($id);
             $gym->name = $validated['name'];
             $gym->longitude = $validated['name'];
             $gym->latitude = $validated['name'];
             $gym->description = $validated['description'];
             $gym->save();
             return response()->json($gym);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch gym",
                'message'=> $exception->getMessage()
            ], 500);
         }        
    }
    public function deletegym($id){
        try{
            $gym =gym::findOrFail($id);
            $gym->delete();
            return response('gym Deleted Successfully!');
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch gym",
                'message'=> $exception->getMessage()
            ], 500);
        
    }
}
}
