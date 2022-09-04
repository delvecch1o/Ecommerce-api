<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CadastrarController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\FrontendController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user', [CadastrarController::class, 'register']);
Route::post('login', [CadastrarController::class, 'login']);

Route::get('getCategory', [FrontendController::class, 'category']);
Route::get('fetchproducts/{slug}', [FrontendController::class, 'product']);
Route::get('viewproductdetail/{category_slug}/{product_slug}', [FrontendController::class, 'viewproduct']);


Route::middleware(['auth:sanctum','isAPIAdmin'])->group(function (){
   
    Route::get('/checkingAuthenticated', function () {
        return response()->json(['message' => 'You are in', 'status' => 200], 200);
    });
    
    // Category
    Route::get('view-category', [CategoryController::class, 'index']);
    Route::post('store-category', [CategoryController::class, 'store']);
    Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('update-category/{id}', [CategoryController::class, 'update']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);
    Route::get('all-category', [CategoryController::class, 'allcategory']);

    //Products
    Route::post('store-product', [ProductController::class, 'store']);
    Route::get('view-product', [ProductController::class, 'index']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('update-product/{id}', [ProductController::class, 'update']);


});

Route::middleware(['auth:sanctum'])->group(function (){
   
    Route::post('logout', [CadastrarController::class, 'logout']);

});


/*
Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('logout', [CadastrarController::class, 'logout']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/
