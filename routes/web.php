<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {return view('auth.login');});


Auth::routes();
// Auth::routes(['register' => false]);

// Route::get('/{page}', 'AdminController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('invoice', "InvoiceController");

Route::resource('Achive', "InvoiceAchiveController");

Route::get('invoice/edit/{id}', "InvoiceController@edit");

Route::get('invoiceDetails/{id}', "InvoiceDetailsController@edit");

Route::get('View_file/{invoice_number}/{attachment}', "InvoiceDetailsController@open_file");

Route::get('dowonload/{invoice_number}/{attachment}', "InvoiceDetailsController@open_file");

Route::post("delete-file","InvoiceDetailsController@destroy")->name("delete_file");

Route::get('/section/{id}', 'InvoiceController@getproducts')->name('home');

Route::get('Status/{id}', 'InvoiceController@show')->name('Status_show');

Route::post('Status_Update/{id}', 'InvoiceController@Status_Update')->name('Status_Update');

Route::get('Invoice_Paid','InvoiceController@Invoice_Paid');

Route::get('Invoice_UnPaid','InvoiceController@Invoice_UnPaid');

Route::get('Print_invoice/{id}','InvoiceController@Print_invoice');

Route::get('Invoice_Partial','InvoiceController@Invoice_Partial');

Route::resource('section', "SectionController");

Route::resource('product', "ProductController");

Route::get('export_invoices', 'InvoiceController@export');

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles','RoleController');
    Route::resource('users','UserController');

});

Route::get('Invoices_Report', 'Invoices_Report@index');
Route::post('Search_invoices', 'Invoices_Report@Search_invoices');

Route::get('customers_report', 'Customers_Report@index');
Route::post('Search_customers', 'Customers_Report@Search_customers');

Route::get('MarkAsRead_all','InvoiceController@MarkAsRead_all');

