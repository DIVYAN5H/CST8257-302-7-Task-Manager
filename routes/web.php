<?php

use App\Http\Controllers\FirebaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use Kreait\Laravel\Firebase\Facades\Firebase;

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

Route::get('/landing', [Controller::class, 'isLogged'])->name('landing');

Route::get('/home', [FirebaseController::class,'loginDisplay']
)->name('home');

// User Management
Route::post('/home',[FirebaseController::class,'loginFunc']);
Route::post('register',[FirebaseController::class,'registerFunc']);

Route::post('/logout1', [Controller::class, 'logOut']);
Route::post('/userUpdate', [FirebaseController::class, 'updateUser']);

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('add',[FirebaseController::class,'addform']);

// require __DIR__.'/auth.php';
Route::get('newList',[FirebaseController::class,'addListDisplay']);
Route::post('newList',[FirebaseController::class,'addList']);
Route::post('/listDelete', [FirebaseController::class, 'deleteList']);


Route::post('/taskAdd', [FirebaseController::class, 'addTaskToList']);
Route::post('/taskDelete', [FirebaseController::class, 'deleteTask']);
Route::post('/taskUpdate', [FirebaseController::class, 'updateTask']);


