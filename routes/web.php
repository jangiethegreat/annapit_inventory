<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\RequestTicketController;
use App\Http\Controllers\RejectedTicketController;
use App\Http\Controllers\AcceptedTicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('categories', CategoryController::class);
Route::resource('stocks', StockController::class);
Route::resource('request_tickets', RequestTicketController::class);
Route::post('/rejected-tickets', [RejectedTicketController::class, 'store'])->name('rejected_tickets.store');
Route::get('/request_tickets/{id}/create_rejected', [RejectedTicketController::class, 'create'])->name('rejected_tickets.create');
Route::get('/rejected_tickets', [RejectedTicketController::class, 'index'])->name('rejected_tickets.index');

// Route::get('/accepted_requests', [AcceptedRequestController::class, 'index'])->name('accepted_requests.index');
// Route::get('/accepted_requests/create/{id}', [AcceptedRequestController::class, 'create'])->name('accepted_requests.create');
Route::put('/accepted_tickets/{id}', [AcceptedTicketController::class, 'update'])->name('accepted_tickets.update');

Route::resource('accepted_tickets', AcceptedTicketController::class);

Route::post('/stocks/deploy', [StockController::class, 'deploy'])->name('stocks.deploy');
