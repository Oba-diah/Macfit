<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ResendEmailVerification extends Controller
{
    public function resend(Request $request) {
        $request ->validate([
            'email'=>'required|email'
        ]);
        $user =User::where('email',$request->email)->first();

         if(!$user){
            return response()->json([
                'message'=>'user not found'
            ],404);
         }

         if ($user->hasverifiedemail()){
            return response()->json([
                'message'=>'Email is already verified'
            ],200);
         }

         $signedUrl = URL::temporarySignedroute(
          'verification.verify',
          now()->addMinutes(60),
          [
            'id' =>$user->id,
            'hash'=>sha1($user->email)
          ]
         );

         $user->notify(new VerifyEmailNotification($signedUrl));

         return response()->json([
            'message'=>'Verification Email Resent Succeccfully.'
         ],200);
    }
}
