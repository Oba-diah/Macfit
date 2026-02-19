<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function createCategory(Request $request){
        $validated= $request->validate([
            'name' => 'required|string|unique:categorys,name',
            'description' =>'nullable|string|max:1000',
        ]);
        $category=new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        try {
            $category->save();
            return response()->json($category);
        }
        catch (\Exception $e){
            return response()->json([
                'error' =>"Failed to create category",
                'message'=> $e->getMessage()
            ]);
        }
    }
    public function readAllCategories(){
        try{
            $categories = Category::all();
            return response()->json($categories);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch category",
                'message'=> $exception->getMessage()
            ], 500);
        }
    }
    public function readCategory($id){
        try{
            $category= Category::findOrfail($id);
            return response()->json($category);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch category",
                'message'=> $exception->getMessage()
            ], 500);
         }

    }
    public function updateCategory(Request $request,$id){
         $validated= $request->validate([
            'name' => 'required|string:categorys,name',
            'description' =>'nullable|string|max:1000',
         ]);
        try{
             $existingCategory= Category::findOrfail($id);
             $existingCategory->name =$validated['name'];
             $existingCategory->description =$validated['description'];
             $existingCategory->save();
             return response()->json($existingCategory);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch category",
                'message'=> $exception->getMessage()
            ], 500);
         }        
    }
    public function deleteCategory($id){
        try{
            $category =Category::findOrFail($id);
            $category->delete();
            return response('Category Deleted Successfully!');
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch category",
                'message'=> $exception->getMessage()
            ], 500);
        
    }
}
}
    

