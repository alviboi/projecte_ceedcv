<?php


use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/demo', 'demo')->name('demo');

// Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::get('/user_cefire/{num}', 'App\Http\Controllers\UserController@este')->name('user_cefire');


Route::resources([
    'cefire' => App\Http\Controllers\cefireController::class,
    'centres' => App\Http\Controllers\centresController::class,
    'compensa' => App\Http\Controllers\compensaController::class,
    'curs' => App\Http\Controllers\cursController::class,
    'guardia' => App\Http\Controllers\guardiaController::class,
    'lectura_rfid' => App\Http\Controllers\lectura_rfidController::class,
    'notificacions' => App\Http\Controllers\notificacionsController::class,
    'permis' => App\Http\Controllers\permisController::class,
    'user' => App\Http\Controllers\UserController::class,
    'visita' => App\Http\Controllers\visitaController::class,
]);
