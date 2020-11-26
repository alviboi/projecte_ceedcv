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


Route::view('/demo', 'demo')->name('demo');


Route::get('home', 'HomeController@index')->name('home');
Route::get('/user_cefire/{num}/', 'UserController@este')->name('user_cefire')->middleware('auth');

Route::group(['middleware' => 'auth'], function() {
    Route::resources([
        'cefire' => cefireController::class,
        'centres' => centresController::class,
        'compensa' => compensaController::class,
        'curs' => cursController::class,
        'guardia' => guardiaController::class,
        'lectura_rfid' => lectura_rfidController::class,
        'notificacions' => notificacionsController::class,
        'permis' => permisController::class,
        'user' => UserController::class,
        'visita' => visitaController::class,
    ]);
});

