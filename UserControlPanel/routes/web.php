<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SerialController;
use App\Http\Middleware\CheckPermission;

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

Route::get('/dashboard2', [HomeController::class, 'admin_view'])->middleware('auth', 'checkPermission:0');
Route::get('/adminteam', [HomeController::class, 'showAdminTeam'])->middleware('auth', 'checkPermission:0');

Route::get('/manage', [HomeController::class, 'serialManage']);

Route::get('/permissions', [HomeController::class, 'permissionManage']);

Route::get('/serials', [SerialController::class, 'show']);

Route::group([
    'controller' => \App\Http\Controllers\SerialController::class,
], static function () {
    Route::get('/serial/show',  'show')->name('serial.show')->middleware('checkPermission:1');
    Route::get('/serial/create',  'create')->middleware('checkPermission:0');
    Route::post('/serial/store', 'store')->middleware('checkPermission:0');
    Route::get('/serial/manage', 'manage')->name('serial.manage')->middleware('checkPermission:1');
    Route::post('/serial/accept/{id}', 'accept')->middleware('checkPermission:1');
    Route::post('/serial/decline/{id}', 'decline')->middleware('checkPermission:1');
    /*Route::post('news/update/{id}', 'update');
    Route::get('news/show', 'show');
    Route::delete('news/destroy/{id}', 'destroy');*/

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\NameController::class,
], static function () {
    Route::get('/name/show',  'show')->name('name.show');
    Route::get('/name/create',  'create');
    Route::post('/name/store', 'store');
    Route::get('/name/manage', 'manage')->name('name.manage');
    Route::post('/name/accept/{id}', 'accept');
    Route::post('/name/decline/{id}', 'decline');
    /*Route::post('news/update/{id}', 'update');
    Route::get('news/show', 'show');
    Route::delete('news/destroy/{id}', 'destroy');*/

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\BanController::class,
], static function () {
    Route::get('/ban',  'show')->middleware('checkPermission:2');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\PetController::class,
], static function () {
    Route::get('/mypets',  'index')->middleware('checkPermission:2', 'auth');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\CharacterController::class,
], static function () {
    Route::get('/characters',  'index')->middleware('checkPermission:2', 'auth');
    Route::get('/characters/edit/{id}', 'edit')->middleware('checkPermission:2', 'auth');
    Route::put('/characters/update/{id}', 'update')->middleware('checkPermission:2', 'auth');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\UserController::class,
], static function () {
    Route::get('/users',  'index')->middleware('checkPermission:2');
    Route::get('/users/edit/{id}', 'edit')->middleware('checkPermission:2');
    Route::put('/users/update/{id}', 'update')->middleware('checkPermission:2');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\VehicleController::class,
], static function () {
    Route::get('/vehicles',  'index')->middleware('checkPermission:2');
    Route::get('/myvehicles', 'getVehiclesByOwner');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\FactionController::class,
], static function () {
    Route::get('/factions',  'index');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\ProfilController::class,
], static function () {
    Route::get('/profil', 'show')->middleware();
    Route::get('/profilselector', 'index');
    Route::post('/profil/select', 'selectCharacter');

});
