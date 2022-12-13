<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\NewsController;

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

Route::post('/register', [AuthenticateController::class, 'register'])->name('register');
Route::post('/login', [AuthenticateController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth.passport']], function() {
    Route::prefix('news')->name('news.')->group(function () {
        Route::post('/', [NewsController::class, 'index']);
        Route::get('/{slug}/show', [NewsController::class, 'show']);

        Route::group(['middleware' => ['admin']], function() {
            Route::post('/create', [NewsController::class, 'store']);
            Route::post('/{slug}/update', [NewsController::class, 'update']);
            Route::delete('/{slug}/delete', [NewsController::class, 'delete']);
        });

        Route::group(['middleware' => ['user']], function() {
            Route::post('/{slug}/comment', [NewsController::class, 'comment']);
        });
    });
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
