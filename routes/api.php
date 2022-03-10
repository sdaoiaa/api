<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\isAdmin;
use App\Http\Resources\UserCollection;
use App\Http\Resources\VideoCollection;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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
Route::get('allFilms',function () {
    return new VideoCollection(Video::all());
})->middleware('auth:sanctum');
Route::get('pelis',[VideoController::class, 'filmVideo'])
->middleware('auth:sanctum');
Route::get('series', [VideoController::class, 'serieVideo'])
->middleware('auth:sanctum');
Route::get('find/{title}', [VideoController::class, 'findByTitle'])
->middleware('auth:sanctum');
// login user
Route::post('login', [LoginController::class, 'apiLogin']);
// video by genere
Route::get('videoByGenere/{genere}', [VideoController::class, 'videoByGenere'])
->middleware('auth:sanctum')->middleware('isAdmin');
// video modification
Route::put('modifyVideo/{id}', [VideoController::class, 'updateVideo'])
->middleware('auth:sanctum')->middleware('isAdmin');
// video delete
Route::delete('deleteVideo/{id}', [VideoController::class, 'deleteVideo'])->middleware('auth:sanctum')
->middleware('isAdmin');
// user create
Route::post('signin',[UserController::class, 'signup'])
->middleware('auth:sanctum');
// user delete
Route::delete('deleteUser/{id}', [UserController::class, 'delete']);
// all users
Route::get('allUsers',function () {
    return new UserCollection(User::all());
})->middleware('auth:sanctum')->middleware('isAdmin');