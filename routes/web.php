<?php

use App\Http\Controllers\Pemain\PemainController;
use App\Http\Controllers\Performansi\PerformansiController;
use App\Http\Controllers\Team\TeamController;
use App\Livewire\Team\Team;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/team', TeamController::class)->parameters([
        'team' => 'team:slug',
    ]);

    Route::resource('/performansi', PerformansiController::class)->parameters([
        'performansi' => 'pemain:slug',
    ]);

    Route::resource('/pemain', PemainController::class)->parameters([
        'pemain' => 'pemain:slug',
    ]);
});
