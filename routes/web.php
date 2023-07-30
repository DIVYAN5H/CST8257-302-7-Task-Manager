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
    return Inertia::render('Home');
});

Route::get('/landing', function () {
    return Inertia::render('Landing');
});

Route::get('/home', [FirebaseController::class,'loginDisplay']
)->name('home');

Route::post('/home',[FirebaseController::class,'loginFunc']);

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

Route::get('add',[FirebaseController::class,'addform']);

require __DIR__.'/auth.php';


Route::get('firebaseTest',[FirebaseController::class,'index']);

// [FirebaseController::class,'index']
// public function index(){
//     return view('firebase.tasks.index');
// } 

Route::get('new',[FirebaseController::class,'addDisplay']);
Route::post('new',[FirebaseController::class,'addFunc']);

Route::get('registerTest',[FirebaseController::class,'registerDisplay']);
Route::post('register',[FirebaseController::class,'registerFunc']);

//Route::get('login',[FirebaseController::class,'loginDisplay']);
