<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::namespace('\Api\Controllers')->group(function() {
//     Route::prefix('/api')->group(function() {
        
        //Login
        Route::post('/login', 'Auth\AuthController@login')->name('api.login');
        
        //Need Authorization (JWT)
        // Route::middleware(JWTMiddleware::class)->group(function() {

            require __DIR__."/../api/Routes/api.php";
            
        // });
    // });
// });

