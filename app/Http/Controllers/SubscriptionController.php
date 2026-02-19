<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function createSubscription(Request $request){
        $validated= $request->validate([
            'name' => 'required|string:subscriptions,name',
            'users_id'=>'required|exists:users,id',
            'bundles_id'=>'required|exists:bundles,id',
            'description' =>'nullable|string|max:1000',
        ]);
        $subscription=new Subscription();
        $subscription->name = $validated['name'];
        $subscription->description = $validated['description'];
        $subscription->save();
        try {
            $subscription->save();
            return response()->json($subscription);
        }
        catch (\Exception $e){
            return response()->json([
                'error' =>"Failed to create subscription",
                'message'=> $e->getMessage()
            ]);
        }
    }
    public function readAllSubscriptions(){
        try{
            $subscriptions = Subscription::all();
            return response()->json($subscriptions);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch subscription",
                'message'=> $exception->getMessage()
            ], 500);
        }
    }
    public function readSubscription($id){
        try{
            $subscription= Subscription::findOrfail($id);
            return response()->json($subscription);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch subscription",
                'message'=> $exception->getMessage()
            ], 500);
         }

    }
    public function updateSubscription(Request $request,$id){
         $validated= $request->validate([
            'name' => 'required|string:subscriptions,name',
            'users_id'=>'required|exists:users,id',
            'bundles_id'=>'required|exists:bundles,id',
            'description' =>'nullable|string|max:1000',
         ]);
        try{
             $subscription= Subscription::findOrfail($id);
             $subscription->name =$validated['name'];
             $subscription->description =$validated['description'];
             $subscription->save();
             return response()->json($subscription);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch subscription",
                'message'=> $exception->getMessage()
            ], 500);
         }        
    }
    public function deleteSubscription($id){
        try{
            $subscription =Subscription::findOrFail($id);
            $subscription->delete();
            return response('Subscription Deleted Successfully!');
        }
        catch(\Exception $exception){
            return response()->json([
                'error' =>"Failed to fetch subscription",
                'message'=> $exception->getMessage()
            ], 500);
        
    }
}
}
