<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdvantageController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\SettingController;


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
Route::post('/logout', [AuthController::class, 'logout'])->middleware("auth:api");

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End Auth Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
