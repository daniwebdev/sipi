<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use TrusCRUD\Core\Middleware\CheckPermission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::namespace('\Frontend')->group(function() {
    Route::get('/', 'PublicController@index');
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::middleware(['auth', CheckPermission::class])->group(function() {
    require __DIR__ . '/app.php';
});