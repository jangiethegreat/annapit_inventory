<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\RequestTicketController;
use App\Http\Controllers\RejectedTicketController;
use App\Http\Controllers\AcceptedTicketController;
use App\Http\Controllers\DeployedController;

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
// Route::get('/accepted_requests/create/{id}', [AcceptedTicketController::class, 'create'])->name('accepted_requests.create');
// Route::put('/accepted_requests', [AcceptedTicketController::class, 'update'])->name('accepted_requests.update');

Route::resource('accepted_tickets', AcceptedTicketController::class);

Route::get('/request_tickets/{id}/create_accepted', [AcceptedTicketController::class, 'create'])->name('accepted_tickets.create');

Route::get('/accepted_tickets/{id}/deploy', [AcceptedTicketController::class, 'deploy'])->name('accepted_tickets.deploy');
Route::post('stocks/{id}/addtocart', [StockController::class, 'addtocart'])->name('stocks.addtocart');
Route::get('/cart', [StockController::class, 'cart'])->name('cart.index');
Route::get('/cart/remove/{id}', [StockController::class, 'removeCartItem'])->name('cart.remove');
Route::get('/cart/clear', [StockController::class, 'clearCart'])->name('cart.clear');

Route::resource('deployeds', DeployedController::class);
Route::get('/deployeds/{id}/download-pdf', [DeployedController::class, 'downloadPdf'])->name('deployeds.downloadPdf');
Route::get('/deployed-items/download-reports', [DeployedController::class, 'downloadReports'])->name('deployedItems.downloadReports');
