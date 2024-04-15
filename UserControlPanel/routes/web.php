<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/test-db', function () {
    $user = new \App\Models\Vehicles();  // Create a new instance of User
    return $user->getConnectionName();  // Should return 'gs_data'
});

Route::get('/adminpanel', [HomeController::class, 'admin_view']);

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\SerialController::class,
], static function () {
    Route::get('serial/show',  'show');
    Route::get('serial/create',  'create');
    Route::post('news/store', 'store');
    Route::get('news/edit/{id}', 'edit');
    Route::post('news/update/{id}', 'update');
    Route::get('news/show', 'show');
    Route::delete('news/destroy/{id}', 'destroy');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\ProfilController::class,
], static function () {
    Route::get('/profil/{identifier}', 'show');
    Route::get('serial/show',  'show');
    Route::get('serial/create',  'create');
    Route::post('news/store', 'store');
    Route::get('news/edit/{id}', 'edit');
    Route::post('news/update/{id}', 'update');
    Route::get('news/show', 'show');
    Route::delete('news/destroy/{id}', 'destroy');

});
