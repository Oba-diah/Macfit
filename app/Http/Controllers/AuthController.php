<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4|max:15|confirmed',
            'user_image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max'
        ]);
        if ($request->role_id) {
            $role_id =$request->role_id;
        }else{
        $role = Role::where('name','user')->first();
        $role_id = $role->id;
        }
        $role = Role::where('name','user')->first();
        
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $role->id;
        $user->password = Hash::make($validated['password']);

        if ($request->hasFile('user_image')) {
            $filename =$request->file('user_image')->store('users','public');
            }else{
                $filename = null;

            $user->user_image =$filename; 

        try {
            $user->save();
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Registration failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
 }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid Credentials'
            ], 401);
        }
        $token = $user->createToken("auth_token")->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Login Successfully',
                'user' => $user,
                'abilities' => $user->abilities(),
            ], 200);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successfully'
        ]);

    }
}
    