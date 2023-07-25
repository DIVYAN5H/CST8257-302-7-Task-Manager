<?php

use App\Http\Controllers\FirebaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
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

Route::get('/landing', function() {
    return Inertia::render('Landing');
});


Route::get('/new', function() {
    return Inertia::render('New');
});

Route::get('/home', function() {
    return Inertia::render('Home');
});

Route::get('/test2', function() {
    return Inertia::render('Test2');
});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('firebaseTest',[FirebaseController::class,'index']);

// [FirebaseController::class,'index']
// public function index(){
//     return view('firebase.tasks.index');
// } 

Route::get('addTest',[FirebaseController::class,'addDisplay']);
Route::post('addTest',[FirebaseController::class,'addFunc']);

Route::get('registerTest',[FirebaseController::class,'registerDisplay']);
Route::post('registerTest',[FirebaseController::class,'registerFunc']);

Route::get('loginTest',[FirebaseController::class,'loginDisplay']);
Route::post('loginTest',[FirebaseController::class,'loginFunc']);