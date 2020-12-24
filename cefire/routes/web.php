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

// Route::get('/home', function () {
//     return view('home')->with(['seccio' => 'contents.principal']);
// });

Route::get('/home', 'UserController@home')->middleware('auth');;




// Route::get('home', 'HomeController@index')->name('home');

Route::get('/user_cefire/{num}/{any}/{mes}', 'UserController@get_cefire')->middleware('auth');
Route::get('/user_compensa/{num}/{any}/{mes}', 'UserController@get_compensa')->middleware('auth');
Route::get('/user_curs/{num}/{any}/{mes}', 'UserController@get_curs')->middleware('auth');
Route::get('/user_guardia/{num}/{any}/{mes}', 'UserController@get_guardia')->middleware('auth');
Route::get('/user_permis/{num}/{any}/{mes}', 'UserController@get_permis')->middleware('auth');
Route::get('/user_visita/{num}/{any}/{mes}', 'UserController@get_visita')->middleware('auth');
Route::get('/user_all/{de}/{fins}', 'UserController@get_all')->middleware('auth');
Route::get('/user_get', 'UserController@get_user')->middleware('auth');
Route::post('/get_usuaris_ldap', 'UserController@get_usuaris_ldap')->middleware('auth');



Route::prefix('complet')->group(function () {
    Route::get('/cefire/{any}/{mes}', 'cefireController@get_data_index')->middleware('auth');
    Route::get('/compensa/{any}/{mes}', 'compensaController@get_data_index')->middleware('auth');
    Route::get('/curs/{any}/{mes}', 'cursController@get_data_index')->middleware('auth');
    Route::get('/guardia/{any}/{mes}', 'guardiaController@get_data_index')->middleware('auth');
    Route::get('/permis/{any}/{mes}', 'permisController@get_data_index')->middleware('auth');
    Route::get('/visita/{any}/{mes}', 'visitaController@get_data_index')->middleware('auth');
});




Route::get('/dia_cefire/{dia}/{mati}', 'UserController@dia_cefire')->name('dia_cefire')->middleware('auth');
Route::get('/dia_compensa/{dia}/{mati}', 'UserController@dia_compensa')->name('dia_compensa')->middleware('auth');
Route::get('/dia_curs/{dia}/{mati}', 'UserController@dia_curs')->name('dia_curs')->middleware('auth');
Route::get('/dia_visita/{dia}/{mati}', 'UserController@dia_visita')->name('dia_vista')->middleware('auth');
Route::get('/dia_guardia/{dia}/{mati}', 'UserController@dia_guardia')->name('dia_guardia')->middleware('auth');
Route::get('/dia_permis/{dia}/{mati}', 'UserController@dia_permis')->name('dia_permis')->middleware('auth');
Route::get('/guardia/totes/{mes}/{any}', 'guardiaController@get_data_index2')->name('guardia_totes')->middleware('auth');


Route::get('/contar/{desde}/{fins}', 'cefireController@contar_cefires')->name('guardia_totes')->middleware('auth');


Route::post('guardia/insert','guardiaController@put_guardia_id')->name('put_guardia_id')->middleware('auth');

Route::post('upload_permis','permisController@upload')->middleware('auth');
Route::post('download_permis','permisController@download')->middleware('auth');



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
        'avisos' => avisosController::class,
        'control' => ControlController::class
    ]);
});

