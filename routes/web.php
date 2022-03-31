<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransactionDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/', [AuthenticatedSessionController::class, 'create']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
Route::resource('operations', OperationController::class);
Route::resource('transactions', TransactionsController::class);
Route::resource('transdashboard', TransactionDashboardController::class);
require __DIR__ . '/auth.php';
