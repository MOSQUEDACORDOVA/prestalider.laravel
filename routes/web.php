<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\OtherIncomeController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\RequestController;


use App\Http\Controllers\WalletController;
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
    return redirect()->route('login');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/all-notifications', 'HomeController@allNotifications')->name('all-notifications');
//
Route::get('/solicitudes',[RequestController::class,'index']);
Route::get('/solicitudes-formulario',[RequestController::class,'formularioCreacion']);
//
Route::get('/clientes',[CustomerController::class,'index']);
//
Route::get('/prestamos',[LoanController::class,'index']);
Route::get('/prestamos-detalle',[LoanController::class,'detallePrestamo']);
//
Route::get('/pagos',[PaymentController::class,'index']);
Route::get('/cajas',[BoxController::class,'index']);
Route::get('/gastos',[BillController::class,'index']);
Route::get('/otros-ingresos',[OtherIncomeController::class,'index']);
Route::get('/cartera',[WalletController::class,'index']);
Route::resource('roles', RoleController::class);
    Route::resource('permissions',PermissionController::class);
    Route::resource('users',UserController::class);
});
