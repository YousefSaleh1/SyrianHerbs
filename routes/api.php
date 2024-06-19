<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdvantageController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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


/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// Policy Requests ////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::apiResource('policy', PolicyController::class);

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End Policy Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////Contact Messages Routes ////////////////////////
Route::post('/addContactMessage', [ContactMessageController::class, 'store']);
Route::middleware(['auth:api'])->group(function () {
    Route::get('/allContactMessages', [ContactMessageController::class, 'index']);
    Route::get('/showContactMessage/{contactMessage}', [ContactMessageController::class, 'show']);
    Route::delete('/deleteContactMessage/{contactMessage}', [ContactMessageController::class, 'destroy']);
});

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// Hero Requests ////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/hero/{hero}', [HeroController::class, 'show']);
Route::put('/hero/{hero}/update', [HeroController::class, 'update'])->middleware('api');
Route::put('/hero/{hero}/update', [HeroController::class, 'update']);

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End Hero Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// Story Requests ///////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/stories', [StoryController::class, 'index']);
Route::get('/story/{story}', [StoryController::class, 'show']);
Route::post('/story-create', [StoryController::class, 'store'])->middleware('auth:api');
Route::put('/story/{story}/update', [StoryController::class, 'update'])->middleware('auth:api');
Route::delete('/story/{story}/delete', [StoryController::class, 'destroy'])->middleware('auth:api');

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End Story Requests /////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// certification Requests ///////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/certifications', [CertificationController::class, 'index']);
Route::get('/certification/{certification}', [CertificationController::class, 'show']);
Route::post('/certification-create', [CertificationController::class, 'store'])->middleware('auth:api');
Route::put('/certification/{certification}/update', [CertificationController::class, 'update'])->middleware('auth:api');
Route::delete('/certification/{certification}/delete', [CertificationController::class, 'destroy'])->middleware('auth:api');

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// End certification Requests /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// Evaluation Requests ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/evaluations', [EvaluationController::class, 'index']);
Route::get('/evaluation/{evaluation}', [EvaluationController::class, 'show']);
Route::post('/evaluation-create', [EvaluationController::class, 'store'])->middleware('auth:api');
Route::put('/evaluation/{evaluation}/update', [EvaluationController::class, 'update'])->middleware('auth:api');
Route::delete('/evaluation/{evaluation}/delete', [EvaluationController::class, 'destroy'])->middleware('auth:api');

/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// End Evaluation Requests //////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////
////////////////////////////Setting Request ////////////////////////////
////////////////////////////////////////////////////////////////////////

Route::get('/setting/{setting}', [SettingController::class, 'show']);
Route::put('/setting/{setting}/update', [SettingController::class, 'update'])->middleware('auth:api');

////////////////////////////////////////////////////////////////////////
///////////////////////// End Setting Request ///////////////////////////
////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// About us routes ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
Route::get('/about/{about}', [AboutController::class, 'show']);
Route::put('/about/{about}', [AboutController::class, 'update'])->middleware('auth:api');

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End About us routes ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// advantage routes ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
Route::get('/advantage/{advantage}', [AdvantageController::class, 'show']);
Route::put('/advantage/{advantage}', [AdvantageController::class, 'update'])->middleware('auth:api');

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// End advantage routes ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/contacts/{contact}', [ContactController::class, 'show']);
Route::put('/contacts/{contact}', [ContactController::class, 'update'])->middleware('auth:api');

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// Category Requests ///////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/categorys', [CategoryController::class, 'index']);
Route::post('/add', [CategoryController::class, 'store'])->middleware('auth:api');;
Route::put('/update/{category}', [CategoryController::class, 'update'])->middleware('auth:api');
Route::get('/categorys/{category}', [CategoryController::class, 'show'])->middleware('auth:api');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->middleware('auth:api');
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// End Category Requests //////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////



//-----------------------------------Brand Requests------------------------------------------//
Route::get('/brands', [BrandController::class, 'index']);
Route::get('/brands/{brand}', [BrandController::class, 'show']);
Route::middleware(['auth:api'])->group(function () {
    Route::post('/create-brand', [BrandController::class, 'store']);
    Route::post('/brands/{brand}', [BrandController::class, 'update']);
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy']);


    /* Search By BrandName */
    Route::get('/brands/searchbybrandName/{searchBrand}', [BrandController::class, 'searchByBrandName']);
});
//-----------------------------------End Brand Requests------------------------------------------//




/* ------------------------------------ Products Requests --------------------------------------- */
Route::middleware(['auth:api'])->group(function () {
    Route::post('/products/create', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    /* duplicate method */
    Route::post('products/{product}/duplicate', [ProductController::class, 'duplicateProduct']);

    /* search method By nameProduct */
    Route::get('/products/search/{search}', [ProductController::class, 'search']);

    /* Filter By category */
    Route::get('/products/filterbycategory/{category}', [ProductController::class, 'filterByCategory']);

    /* Filter By Brand */
    Route::get('/products/filterbybrand/{brand}', [ProductController::class, 'filterByBrand']);
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

/*------------------------------- End Of Products ----------------------------------------------*/


/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// Role Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/roles', [RoleController::class, 'index']);
Route::get('/role/{role}', [RoleController::class, 'show']);
Route::post('/add-role', [RoleController::class, 'store']);
Route::put('/role/{role}/update', [RoleController::class, 'update']);
Route::delete('/role/{role}/delete', [RoleController::class, 'destroy']);

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// Role Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// User Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

Route::get('/users', [UserController::class, 'index']);
Route::get('/user/{user}', [UserController::class, 'show']);
Route::post('/add-user', [UserController::class, 'store']);
Route::put('/user/{user}/update', [UserController::class, 'update']);
Route::delete('/user/{user}/delete', [UserController::class, 'destroy']);

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// User Requests //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
