<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;

// Public landing pages
Route::match(['GET', 'HEAD'], '/', function () {
    return view('traderai-template.home');
})->name('home')->middleware(['resolve.country', \App\Http\Middleware\CloakerMiddleware::class]);

// Preserve landing-page form action (index.php) by handling it server-side (no CSRF token in static form)
Route::match(['GET', 'POST'], '/traderai-template/index.php', function () {
    return redirect()->to(route('home') . '#req-form-section');
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);


Route::view('/safe', 'traderai-template.safe')->name('safe');
Route::view('/redirect', 'traderai-template.redirect')->name('redirect');

// Lead submissions
Route::post('/leads', [LeadsController::class, 'store'])->name('leads.store');
// Export leads CSV (admin check is performed in the controller)
Route::get('/leads/export', [LeadsController::class, 'exportCsv'])->name('leads.export');
