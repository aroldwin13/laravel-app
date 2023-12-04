<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ContributorController;
use App\Http\Controllers\BlogController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/submission', [BlogController::class, 'show'])->name('submission');
    Route::get('/submission', [BlogController::class, 'submission'])->name('submission');
    Route::get('/user', [BlogController::class, 'show'])->name('user');
    Route::get('/user', [BlogController::class, 'user'])->name('user');
    Route::get('/home', [BlogController::class, 'home'])->name('home');
    Route::get('/bookmark', [BlogController::class, 'bookmark'])->name('bookmark');
    Route::get('/references', [BlogController::class, 'references'])->name('references');
    Route::get('/generate', [BlogController::class, 'generate'])->name('generate');
    Route::get('/assessment', [BlogController::class, 'assessment'])->name('assessment');
    Route::get('/account', [BlogController::class, 'account'])->name('account');
    Route::post('/deactivate_acc/{id}', [BlogController::class, 'deactivateAcc']);
    Route::post('/activate_acc/{id}', [BlogController::class, 'activateAcc']);

    
});
Route::get('/editor', [BlogController::class, 'editor'])->name('editor');

Route::post('/delete-account/{id}', [BlogController::class, 'deleteUser'])->name('users.deleteUser');
Route::post('/edit-account/{id}', [BlogController::class, 'updateUser'])->name('users.updateUser');
Route::middleware('auth')->group(function () {
// Route::get('/create-submissions', [BlogController::class, 'create'])->name('submissions.create');
// Route::post('/store-submissions', [BlogController::class, 'store'])->name('submissions.store');
// Route::get('/edit-submissions', [BlogController::class, 'edit'])->name('submissions.edit');
// Route::put('/update-submissions', [BlogController::class, 'update'])->name('submissions.update');
// Route::resource('submissions',BlogController::class);
});
    
require __DIR__ . '/auth.php';