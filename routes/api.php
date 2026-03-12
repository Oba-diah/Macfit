<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\gymController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\ResendEmailVerificationController;
use App\Http\Controllers\UserOtpController;

use App\Models\Bundle;
use App\Models\Category;

    // public routes
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/verify-otp', [UserOtpController::class, 'verifyOtp']);


            // Email Verification
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->name('verification.verify')
        ->middleware(['signed', 'throttle:6,1']);
Route::post('/email/verify/{id}/{hash}', [verifyemailcontroller::class, 'resend'])
        ->middleware(['signed', 'throttle:6,1']);

        // protected routes
Route::middleware('auth:sanctum')-> group(function () 
{
Route::get('/userInfo', [Authcontroller::class, 'userInfo']);

Route::post('/logout', [AuthController::class,'logout']);

route::post('/saveRole',[RoleController::class,'createRole']);
route::get('/getRoles',[RoleController::class,'readAllRoles']);
route::get('/getRoles/id',[RoleController::class,'readRole']);
route::post('/updateRole/id',[RoleController::class,'updateRole']);
route::delete('/deleteRole/id',[RoleController::class,'deleteRole']);

route::post('/saveCategory',[CategoryController::class,'createRole']);
route::get('/getCategory',[CategoryController::class,'readAllRoles']);
route::get('/getCategory/id',[CategoryController::class,'readRole']);
route::post('/updateCategory/id',[CategoryController::class,'updateRole']);
route::delete('/deleteCategory/id',[CategoryController::class,'deleteRole']);

route::post('/saveGym',[GymController::class,'createGym']);
route::get('/getGyms',[GymController::class,'readAllGyms']);
route::get('/getGym/id',[GymController::class,'readGym']);
route::post('/updateGym/id',[GymController::class,'updateGym']);
route::delete('/deleteGym/id',[GymController::class,'deleteGym']);

route::post('/saveBundle',[BundleController::class,'createBundle']);
route::get('/getBundles',[BundleController::class,'readAllBundles']);
route::get('/getBundle/id',[BundleController::class,'readBundle']);
route::post('/updateBundle/id',[BundleController::class,'updateBundle']);
route::delete('/deleteBundle/id',[BundleController::class,'deleteBundle']);

route::post('/saveSubscription',[SubscriptionController::class,'createSubscription']);
route::get('/getSubscription',[SubscriptionController::class,'readAllSubscriptions']);
route::get('/getSubscription/id',[SubscriptionController::class,'readSubscription']);
route::post('/updateSubscription/id',[SubscriptionController::class,'updateSubscription']);
route::delete('/deleteSubscription/id',[SubscriptionController::class,'deleteSubscription']);

route::post('/saveEquipment',[EquipmentController::class,'createEquipment']);
route::get('/getEquipment',[EquipmentController::class,'readAllEquipments']);
route::get('/getEquipment/id',[EquipmentController::class,'readEquipment']);
route::post('/updateEquipment/id',[EquipmentController::class,'updateEquipment']);
route::delete('/deleteEquipment/id',[EquipmentController::class,'deleteEquipment']);

});