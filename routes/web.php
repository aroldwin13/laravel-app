<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProfileController;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/submission', [BlogController::class, 'submission'])->name('submission');
    
    Route::get('/home', [BlogController::class, 'home'])->name('home');
    Route::get('/bookmark', [BlogController::class, 'bookmark'])->name('bookmark');
    Route::get('/references', [BlogController::class, 'references'])->name('references');
});

Route::middleware('auth')->group(function () {
    Route::get('/faculty_Home', [FacultyController::class, 'faculty_Home'])->name('faculty_Home');
    Route::get('/faculty_Bookmark', [FacultyController::class, 'faculty_Bookmark'])->name('faculty_Bookmark');
    Route::get('/faculty_References', [FacultyController::class, 'faculty_References'])->name('faculty_References');
});

Route::get('/create', [BlogController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
Route::post('/store', [BlogController::class, 'store'])->middleware(['auth', 'verified'])->name('store');
Route::get('/edit', [BlogController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit');
Route::post('/update', [BlogController::class, 'update'])->middleware(['auth', 'verified'])->name('update');



require __DIR__ . '/auth.php';
