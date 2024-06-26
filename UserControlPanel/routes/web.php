<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SerialController;
use App\Http\Middleware\CheckPermission;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return abort(404);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\ProfilController::class, 'index'])->name('dashboard');
    return view('admin.profil.selector');
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
    Route::get('/serial/show', 'show')->name('serial.show')->middleware('checkPermission:0');
    Route::get('/serial/create', 'create')->middleware('checkPermission:0');
    Route::post('/serial/store', 'store')->middleware('checkPermission:0');
    Route::get('/serial/manage', 'manage')->name('serial.manage')->middleware('checkPermission:1');
    Route::post('/serial/accept/{id}', 'accept')->middleware('checkPermission:1');
    Route::post('/serial/decline/{id}', 'decline')->middleware('checkPermission:1');


});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\NameController::class,
], static function () {
    Route::get('/name/show', 'show')->name('name.show')->middleware('auth', 'checkPermission:0');
    Route::get('/name/create', 'create')->middleware('auth', 'checkPermission:0');
    Route::post('/name/store', 'store')->middleware('auth', 'checkPermission:0');
    Route::get('/name/manage', 'manage')->name('name.manage')->middleware('auth', 'checkPermission:1');
    Route::post('/name/accept/{id}', 'accept')->middleware('auth', 'checkPermission:1');
    Route::post('/name/decline/{id}', 'decline')->middleware('auth', 'checkPermission:1');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\SuggestionController::class,
], static function () {
    Route::get('/suggestion', 'show')->name('suggestion.show')->middleware('auth', 'checkPermission:0');
    Route::get('/suggestion/manage', 'manage')->middleware('auth', 'checkPermission:0');
    Route::get('/suggestion/{id}', 'mySuggestion')->middleware('auth', 'checkPermission:0');
    Route::get('/createsuggestion', 'create')->middleware('auth', 'checkPermission:0');
    Route::post('/suggestion/store', 'store')->middleware('auth', 'checkPermission:0');

    Route::post('suggestion/accept/{id}', 'accept')->middleware('auth', 'checkPermission:3');
    Route::post('suggestion/reject/{id}', 'reject')->middleware('auth', 'checkPermission:3');


});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\BanController::class,
], static function () {
    Route::get('/ban', 'show')->middleware('checkPermission:2', 'auth');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\ComplaintController::class,
], static function () {
    Route::get('/complaint', 'show')->name('complaint.show')->middleware('auth', 'checkPermission:0');
    Route::get('/complaint/create', 'create')->middleware('checkPermission:0', 'auth');
    Route::post('/complaint/store', 'store')->middleware('checkPermission:0', 'auth');
    Route::get('/complaint/manage', 'manage')->middleware('checkPermission:2', 'auth');
    Route::post('/complaint/accept/{id}', 'accept')->middleware('checkPermission:2', 'auth');
    Route::post('/complaint/reject/{id}', 'reject')->middleware('checkPermission:2', 'auth');
    Route::get('/complaint/{id}', 'showSpecific')->middleware('checkPermission:0', 'auth');


});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\TicketController::class,
], static function () {
    Route::get('/ticket/create', 'create')->middleware('auth', 'checkPermission:0');
    Route::post('/ticket/store', 'store')->middleware('auth', 'checkPermission:0');
    Route::get('/ticket/manage', 'manage')->middleware('auth', 'checkPermission:2');
    Route::get('/ticket/{id}', 'showSpecific')->middleware('auth', 'checkPermission:0');
    Route::post('/ticket/accept/{id}', 'accept')->middleware('auth', 'checkPermission:2');
    Route::post('/ticket/reject/{id}', 'reject')->middleware('auth', 'checkPermission:2');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\PetController::class,
], static function () {
    Route::get('/mypets', 'index')->middleware('checkPermission:2', 'auth');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\CharacterController::class,
], static function () {
    Route::get('/characters', 'index')->middleware('checkPermission:2', 'auth');
    Route::get('/characters/edit/{id}', 'edit')->middleware('checkPermission:2', 'auth');
    Route::put('/characters/update/{id}', 'update')->middleware('checkPermission:2', 'auth');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\UserController::class,
], static function () {
    Route::get('/users', 'index')->middleware('checkPermission:2', 'auth');
    Route::get('/users/edit/{id}', 'edit')->middleware('checkPermission:2', 'auth');
    Route::put('/users/update/{id}', 'update')->middleware('checkPermission:2', 'auth');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\VehicleController::class,
], static function () {
    Route::get('/vehicles', 'index')->middleware('checkPermission:2');
    Route::get('/myvehicles', 'getVehiclesByOwner')->middleware('checkPermission:0', 'auth');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\FactionController::class,
], static function () {
    Route::get('/factions', 'index')->middleware('checkPermission:1', 'auth');

});

Route::group([
    #'middleware' => \App\Http\Middleware\CheckAdmin::class,
    'controller' => \App\Http\Controllers\ProfilController::class,
], static function () {
    Route::get('/profil', 'show')->middleware('auth', 'checkPermission:0');
    Route::get('/profilselector', 'index')->middleware('auth', 'checkPermission:0');
    Route::post('/profil/select', 'selectCharacter')->middleware('auth', 'checkPermission:0');

});
