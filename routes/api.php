<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactMessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// Auth Requests ////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('api');

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End Auth Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////Contact Messages Routes ////////////////////////
Route::post('/addContactMessage',[ContactMessageController::class,'store']);

Route::middleware(['auth:api'])->group(function () {
Route::get('/allContactMessages',[ContactMessageController::class,'index']);
Route::get('/showContactMessage/{id}',[ContactMessageController::class,'show']);
Route::delete('/deleteContactMessage/{id}',[ContactMessageController::class,'destroy']);
});


