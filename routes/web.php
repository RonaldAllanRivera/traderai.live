<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;

// Public landing pages (dynamic template)
Route::match(['GET', 'HEAD'], '/', [PublicPagesController::class, 'home'])
    ->name('home')
    ->middleware(['resolve.country', \App\Http\Middleware\CloakerMiddleware::class]);

// Preserve landing-page form action (index.php) by handling it server-side (no CSRF token in static form)
// Support current and future template folders: /{template}/index.php
Route::match(['GET', 'POST'], '/{template}/index.php', function () {
    return redirect()->to(route('home') . '#req-form-section');
})->where(['template' => '[A-Za-z0-9\-]+' ])
  ->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);


Route::get('/safe', [PublicPagesController::class, 'safe'])->name('safe');
Route::get('/redirect', [PublicPagesController::class, 'redirect'])->name('redirect');

// Lead submissions (rate limited)
Route::post('/leads', [LeadsController::class, 'store'])
    ->middleware('throttle:20,1')
    ->name('leads.store');
// Export leads CSV (admin check is performed in the controller)
Route::get('/leads/export', [LeadsController::class, 'exportCsv'])->name('leads.export');
