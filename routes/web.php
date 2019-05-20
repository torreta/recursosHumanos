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

Route::get('/register', 'UserController@Index');
Route::resource('/register', 'UserController');


/*
Usados en el curso que hice, es para guiarme

Route::get('/expense_reports/{id}/confirmDelete', 'ExpenseReportController@confirmDelete'); //(ruta,controlador@funcion)
Route::get('/expense_reports/{id}/confirmSendMail', 'ExpenseReportController@confirmSendMail'); //(ruta,controlador@funcion)
Route::post('/expense_reports/{id}/sendMail', 'ExpenseReportController@sendMail'); //(ruta,controlador@funcion)

Route::get('/expense_reports/{expense_report}/expenses/create', 'ExpenseController@create'); //(ruta,controlador@funcion)
Route::post('/expense_reports/{expense_report}/expenses', 'ExpenseController@store'); //(ruta,controlador@funcion)


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
