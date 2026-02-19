<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    public function createBundle(Request $request){
        $validated= $request->validate([
            'name' => 'required|string:bundles,name',
            'start time'=>'required',
            'duration'=>'required',
            'description' =>'nullable|string|max:1000',
            'category_id'=>'required|exists:categories,id',
        ]);
        $bundle=new Bundle();
        $bundle->name = $validated['name'];
        $bundle->start_time = $validated['name'];
        $bundle->duration = $validated['name'];
        $bundle->description = $validated['description'];
        $bundle->save();
        try {
            $bundle->save();
            return response()->json($bundle);
        }
        catch (\Exception $e){
            return response()->json([
                'error' =>"Failed to create bundle",
                'message'=> $e->getMessage()
            ]);
        }
    }
    public function readAllBundles(){
        try{
            // $bundles = Bundle::all();
            $bundles = bundle::join('categories', 'bundles.category_id','=','categories_id')
                                ->select('bundles.*', 'categories.name as category_name')
                                ->get();
            return response()->json($bundles);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch bundle",
                'message'=> $exception->getMessage()
            ], 500);
        }
    }
    public function readBundle($id){
        try{
            // $bundle= Bundle::findOrfail($id);
            $bundle = bundle::join('categories', 'bundles.category_id','=','categories_id')
                                ->select('bundles.*', 'categories.name as category_name')
                                ->where('bundles.id', $id)
                                ->first();
            return response()->json($bundle);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch bundle",
                'message'=> $exception->getMessage()
            ], 500);
         }

    }
    public function updateBundle(Request $request,$id){
         $validated= $request->validate([
            'name' => 'required|string:bundles,name',
            'start time'=>'required',
            'duration'=>'required',
            'description' =>'nullable|string|max:1000',
            'category_id'=>'required|exists:categories,id',
         ]);
        try{
        $bundle=new Bundle();
        $bundle->name = $validated['name'];
        $bundle->start_time = $validated['name'];
        $bundle->duration = $validated['name'];
        $bundle->description = $validated['description'];
        $bundle->save();
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch bundle",
                'message'=> $exception->getMessage()
            ], 500);
         }        
    }
    public function deleteBundle($id){
        try{
            $bundle =Bundle::findOrFail($id);
            $bundle->delete();
            return response('Bundle Deleted Successfully!');
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch bundle",
                'message'=> $exception->getMessage()
            ], 500);
        
    }
}
}
