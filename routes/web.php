<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\guru\JadwalController;
use App\Http\Controllers\guru\JadwalMuridController;
use Illuminate\Support\Facades\Auth;



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
    return view('landing');
})->name('landing');

Route::get('/2', function () {
    return view('landing2');
})->name('landing2');

Route::get('/welcome', function () {
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::middleware(['auth', 'role:teacher'])->group(function () {
//     Route::resource('guru/jadwal', JadwalController::class);
// });

// Route::middleware(['auth', 'role:student'])->group(function () {
//     Route::resource('guru/jadwalmurid', JadwalMuridController::class);
// });

Route::get('/redirects', function () {
    $user = Auth::user();

    if ($user->role === 'teacher') {
        return redirect()->route('teacher.jadwal.index');
    }

    if ($user->role === 'student') {
        return redirect()->route('student.jadwal.index');
    }

    // fallback if no role matched
    return redirect('/home');
});


// Route::middleware(['auth', 'role:teacher'])->prefix('guru')->group(function () {
//     Route::resource('jadwal', JadwalController::class);
// });

// Route::middleware(['auth', 'role:student'])->prefix('murid')->group(function () {
//     Route::resource('jadwal', JadwalMuridController::class);
// });

Route::middleware(['auth', 'role:teacher'])->prefix('guru')->name('teacher.')->group(function () {
    Route::resource('jadwal', JadwalController::class);
    Route::get('jadwal/create/{jam}/{hari}', [JadwalController::class, 'createWithTimeSlot'])
        ->name('jadwal.createWithTimeSlot');
});

Route::middleware(['auth', 'role:student'])->prefix('murid')->name('student.')->group(function () {
    Route::resource('jadwal', JadwalMuridController::class);
});


Route::get('/coba', function () {
    return view('coba');
});






