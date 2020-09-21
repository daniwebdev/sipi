<?php

use Illuminate\Support\Facades\Route;

/**
 * Response as JSON
 */
function resJSON($data, $code=200) {
    return response()->json($data, $code);
}

function RouteResourceApi($prefix, $controller) {
    Route::prefix($prefix)->group(function() use ($prefix, $controller) {
        Route::get     ('/', $controller.'@index')->name('api.'.$prefix.'.index');
        Route::post    ('/', $controller.'@store')->name('api.'.$prefix.'.create');
        Route::get     ('/{id}', $controller.'@show')->name('api.'.$prefix.'.show');
        Route::put     ('/{id}', $controller.'@update')->name('api.'.$prefix.'.update');
        Route::delete  ('/{id}', $controller.'@destroy')->name('api.'.$prefix.'.destroy');
    });
}