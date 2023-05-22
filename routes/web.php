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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices' , \App\Http\Controllers\InvoicesController::class);
Route::resource('sections' , \App\Http\Controllers\SectionsController::class);
Route::resource('products' , \App\Http\Controllers\ProductsController::class);
Route::resource('InvoiceAttachments', \App\Http\Controllers\InvoiceAttachmentsController::class);
Route::resource('Archive', \App\Http\Controllers\ArchiveController::class);

Route::get('/section/{id}',[\App\Http\Controllers\InvoicesController::class,'getProducts']);
Route::get('/InvoicesDetails/{id}',[\App\Http\Controllers\InvoicesDateilsController::class,'edit']);

Route::get('Paid_bills' , [\App\Http\Controllers\InvoicesController::class ,'show_Paid_bills']);
Route::get('Unpaid_bills' , [\App\Http\Controllers\InvoicesController::class ,'show_Unpaid_bills']);
Route::get('Partially_paid_bills' , [\App\Http\Controllers\InvoicesController::class ,'Partially_paid_bills']);


Route::get('download/{invoice_number}/{file_name}', [\App\Http\Controllers\InvoicesDateilsController::class,'get_file']);
Route::get('View_file/{invoice_number}/{file_name}', [\App\Http\Controllers\InvoicesDateilsController::class,'open_file']);
Route::post('delete_file', [\App\Http\Controllers\InvoicesDateilsController::class,'destroy'])->name('delete_file');
Route::get('/edit_invoice/{id}', [\App\Http\Controllers\InvoicesController::class,'edit']);
Route::get('/Status_show/{id}', [\App\Http\Controllers\InvoicesController::class,'show'])->name('Status_show');
Route::post('/Status_Update/{id}', [\App\Http\Controllers\InvoicesController::class,'Status_Update'])->name('Status_Update');
Route::get('Print_invoice/{id}',[\App\Http\Controllers\InvoicesController::class,'Print_invoice']);
Route::get('export_invoices', [\App\Http\Controllers\InvoicesController::class,'export']);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles',\App\Http\Controllers\RoleController::class);
    Route::resource('users',\App\Http\Controllers\UserController::class);
});


Route::get('invoices_report', [\App\Http\Controllers\InvoicesReportController::class,'index']);
Route::post('Search_invoices', [\App\Http\Controllers\InvoicesReportController::class,'Search_invoices']);
Route::get('customers_report', [\App\Http\Controllers\CustomersReportController::class,'index'])->name("customers_report");
Route::post('Search_customers', [\App\Http\Controllers\CustomersReportController::class,'Search_customers']);
//
Route::get('MarkAsRead_all',[\App\Http\Controllers\InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');
Route::get('unreadNotifications_count', [\App\Http\Controllers\InvoicesController::class,'unreadNotifications_count'])->name('unreadNotifications_count');
Route::get('unreadNotifications', [\App\Http\Controllers\InvoicesController::class,'unreadNotifications '])->name('unreadNotifications');

Route::get('/{page}', [\App\Http\Controllers\AdminController::class,'index']);

