<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate']);
Route::middleware(['auth'])->prefix('posts')->group(function () {
   Route::post('', [\App\Http\Controllers\PostController::class, 'createItem'])->name('posts_create');
   Route::get('', [\App\Http\Controllers\PostController::class, 'getItems'])->name('posts_read_all');
   Route::get('{id}', [\App\Http\Controllers\PostController::class, 'getItem'])->name('posts_read_one');
   Route::patch('{id}', [\App\Http\Controllers\PostController::class, 'updateItem'])->name('posts_read_one');
   Route::delete('{id}', [\App\Http\Controllers\PostController::class, 'deleteItem'])->name('posts_read_one');
});
