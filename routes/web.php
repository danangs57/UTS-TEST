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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/submit_reimbursement', 'ReimbursementController@store')->name('reimbursement.store');
Route::get('/reimbursement_datatable', 'ReimbursementController@datatable')->name('reimbursement.datatable');
Route::post('/reimbursement_approval', 'ReimbursementController@approval')->name('reimbursement.approval');
Route::post('/reimbursement_rejection', 'ReimbursementController@rejection')->name('reimbursement.rejection');
