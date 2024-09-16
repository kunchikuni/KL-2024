<?php

use App\Http\Controllers\AlbumController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProductController;


//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);  

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {


Route::get('/dashboard', [DashboardController::class, 'index']);


Route::get('/images', [ImageController::class, 'index']);
Route::post('/images', [ImageController::class, 'store']);
Route::get('image/{$id}', [ImageController::class, 'show']);

Route::post('images/{$id}/like', [LikeController::class, 'like']);
Route::post('images/{$id}/unlike', [LikeController::class, 'unlike']);

Route::get('images/{image}/comments', [CommentController::class, 'index']);
Route::post('images/{image}/comments', [CommentController::class, 'store']);
Route::put('images/{image}/comments', [CommentController::class, 'destroy']);

Route::get('/album', [AlbumController::class, 'index']);
Route::post('/album', [AlbumController::class, 'store']);
Route::get('album/{$id}', [AlbumController::class, 'show']);

Route::post('/logout', [AuthController::class, 'logout']);

}); 


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
