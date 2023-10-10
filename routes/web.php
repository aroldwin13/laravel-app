<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\BlogController;
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
    Route::get('/blog', [BlogController::class, 'show'])->name('blog');
    Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
    Route::get('/home', [BlogController::class, 'home'])->name('home');
    Route::get('/bookmark', [BlogController::class, 'bookmark'])->name('bookmark');
    Route::get('/references', [BlogController::class, 'references'])->name('references');
});


Route::get('/components/buttons', function () {
    return Inertia::render('Components/Buttons');
})->middleware(['auth', 'verified'])->name('components.buttons');




Route::post('/store-blogs', [BlogController::class, 'store'])->middleware(['auth', 'verified'])->name('blogs.store');
Route::post('/edit-blogs', [BlogController::class, 'edit'])->middleware(['auth', 'verified'])->name('blogs.edit');
Route::post('/update-blogs', [BlogController::class, 'update'])->middleware(['auth', 'verified'])->name('blogs.update');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('blogs',BlogController::class);

require __DIR__ . '/auth.php';
