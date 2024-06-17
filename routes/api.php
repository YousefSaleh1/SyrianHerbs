<?php

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\StoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
Route::post('/logout', [AuthController::class, 'logout'])->middleware('api');

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End Auth Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////Contact Messages Routes ////////////////////////
Route::post('/addContactMessage', [ContactMessageController::class, 'store']);

//Route::middleware(['auth:api'])->group(function () {
Route::get('/allContactMessages',[ContactMessageController::class,'index']);
Route::get('/showContactMessage/{contactMessage}',[ContactMessageController::class,'show']);
Route::delete('/deleteContactMessage/{contactMessage}',[ContactMessageController::class,'destroy']);
//});

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// Hero Requests ////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/hero/{hero}', [HeroController::class, 'show']);
Route::put('/hero/{hero}/update', [HeroController::class, 'update'])->middleware('api');

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End Hero Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// Story Requests ///////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/stories', [StoryController::class, 'index']);
Route::get('/story/{story}', [StoryController::class, 'show']);
Route::post('/story-create', [StoryController::class, 'store'])->middleware('api');
Route::put('/story/{story}/update', [StoryController::class, 'update'])->middleware('api');
Route::delete('/story/{story}/delete', [StoryController::class, 'destroy'])->middleware('api');

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End Story Requests /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// Evaluation Requests ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/evaluations', [EvaluationController::class, 'index']);
Route::get('/evaluation/{evaluation}', [EvaluationController::class, 'show']);
Route::post('/evaluation-create', [EvaluationController::class, 'store'])->middleware('api');
Route::put('/evaluation/{evaluation}/update', [EvaluationController::class, 'update'])->middleware('api');
Route::delete('/evaluation/{evaluation}/delete', [EvaluationController::class, 'destroy'])->middleware('api');

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// End Evaluation Requests //////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////



 ///////////////////////////Setting Request ///////////////////////
///////////////////////////////////////////////////////////////////////

Route::get('/setting/{id}', [SettingController::class, 'show']);
Route::put('/update/{setting}', [SettingController::class, 'update'])->middleware('api');
Route::post('/setting/add', [SettingController::class, 'store']);


Route::get('/categorys', [CategoryController::class, 'index']);
Route::post('/add', [CategoryController::class, 'store'])->middleware('api');;
Route::put('/update/{category}', [CategoryController::class, 'update'])->middleware('api');
Route::get('/categorys/{category}', [CategoryController::class, 'show'])->middleware('api');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->middleware('api');
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// End Category Requests //////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////



//-----------------------------------Brand Requests------------------------------------------//
Route::middleware(['api'])->group(function () {
    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/brands/{brand}', [BrandController::class, 'show']);
    Route::post('/create-brand', [BrandController::class, 'store']);
    Route::post('/brands/{brand}', [BrandController::class, 'update']);
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy']);
});
//-----------------------------------End Brand Requests------------------------------------------//


