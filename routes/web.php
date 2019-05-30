<?php

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



Route::get('/register', 'UserController@Index')->name('register.index');
Route::post('/register', 'UserController@Store')->name('register.store');
Route::post('/register/create', 'UserController@Create')->name('register.create');
Route::get('/user/{id}/edit/{edit_type}', 'UserController@edit')->name('register.edit');

//Authentication
Route::get('/login','UserController@showLogin')->name('login');
Route::post('/login', 'UserController@Login');
Route::get('/logout', 'UserController@Logout')->name('logout');
Route::get('/candidate','UserController@TestCandidate')->name('candidate')->middleware('logged','IsCandidate');
Route::get('/moderator','UserController@TestModerator')->name('moderator')->middleware('logged','IsModerator');
Route::get('/admin','UserController@TestAdmin')->name('admin')->middleware('logged','IsAdmin');

//Test de autenticador
//Route::get('/admin')

/*
Usados en el curso que hice, es para guiarme

Route::get('/expense_reports/{id}/confirmDelete', 'ExpenseReportController@confirmDelete'); //(ruta,controlador@funcion)
Route::get('/expense_reports/{id}/confirmSendMail', 'ExpenseReportController@confirmSendMail'); //(ruta,controlador@funcion)
Route::post('/expense_reports/{id}/sendMail', 'ExpenseReportController@sendMail'); //(ruta,controlador@funcion)

Route::get('/expense_reports/{expense_report}/expenses/create', 'ExpenseController@create'); //(ruta,controlador@funcion)
Route::post('/expense_reports/{expense_report}/expenses', 'ExpenseController@store'); //(ruta,controlador@funcion)


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
