<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('invoices', 'InvoicesController');
Route::resource('sections', 'SectionsController');
Route::resource('products', 'ProductsController');
Route::get('/section/{id}', 'InvoicesController@getproducts');
Route::get('/InvoicesDetails/{id}', 'InvoicesDetailsController@edit');
Route::get('view_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');
Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@download_file');
Route::post('delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');
Route::resource('InvoiceAttachments', 'InvoiceAttachmentsController');
Route::get('/edit_invoice/{id}', 'InvoicesController@edit');
Route::get('/status_show/{id}', 'InvoicesController@show')->name('status_show');
Route::post('/status_update/{id}', 'InvoicesController@status_update')->name('status_update');
Route::get('/invoice_paid', 'InvoicesController@invoice_paid');
Route::get('/invoice_unpaid', 'InvoicesController@invoice_unpaid');
Route::get('/invoice_partial', 'InvoicesController@invoice_partial');
Route::resource('Archive', 'InvoicesAchiveController');
Route::get('print_invoice/{id}','InvoicesController@print_invoice');
Route::get('export_invoices', 'InvoicesController@export');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    });
Route::get('invoices_report', 'InvoicesReportController@index');   
Route::post('search_invoices', 'InvoicesReportController@search_invoices');
Route::get('customers_report', 'CustomersReportController@index');   
Route::post('search_customers', 'CustomersReportController@search_customers');
Route::get('MarkAsReadAll', 'InvoicesController@MarkAsReadAll');
Route::get('/{page}', 'AdminController@index');
