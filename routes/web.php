<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\EndpointController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/sites', [SiteController::class, 'store']);
Route::delete('/sites/{site}', [SiteController::class, 'destroy']);
Route::post('/sites/{site}/notifications/emails', [SiteController::class, 'SiteNotificationEmail']);
Route::delete('/sites/{site}/notifications/emails', [SiteController::class, 'SiteNotificationEmailDestroy']);

Route::post('/sites/{site}/endpoints', [EndpointController::class, 'store']);
Route::get('/endpoints/{endpoint}', [EndpointController::class, 'index']);
Route::delete('/endpoints/{endpoint}', [EndpointController::class, 'destroy']);
Route::patch('/endpoints/{endpoint}', [EndpointController::class, 'update']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
