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

Route::view('/prova', 'prova')->name('prova');

Route::get('/seccio/{pag?}', function ($pag="principal") {
    return view('contents.'.$pag)->render();
});

Route::get('/home', function () {
    return view('home')->with(['seccio' => 'contents.principal']);
});




// Route::get('home', 'HomeController@index')->name('home');

Route::get('/user_cefire/{num}/', 'UserController@este')->name('user_cefire')->middleware('auth');

Route::get('/dia_cefire/{dia}/{mati}', 'UserController@dia_cefire')->name('dia_cefire')->middleware('auth');
Route::get('/dia_compensa/{dia}/{mati}', 'UserController@dia_compensa')->name('dia_compensa')->middleware('auth');
Route::get('/dia_curs/{dia}/{mati}', 'UserController@dia_curs')->name('dia_curs')->middleware('auth');
Route::get('/dia_visita/{dia}/{mati}', 'UserController@dia_visita')->name('dia_vista')->middleware('auth');
Route::get('/dia_guardia/{dia}/{mati}', 'UserController@dia_guardia')->name('dia_guardia')->middleware('auth');
Route::get('/dia_permis/{dia}/{mati}', 'UserController@dia_permis')->name('dia_permis')->middleware('auth');


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

