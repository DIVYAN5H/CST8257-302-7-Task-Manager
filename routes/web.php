<?php

use App\Http\Controllers\FirebaseController;
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

Route::get('firebaseTest',[FirebaseController::class,'index']);

// [FirebaseController::class,'index']
// public function index(){
//     return view('firebase.tasks.index');
// } 

Route::get('addTest',[FirebaseController::class,'addDisplay']);
Route::post('addTest',[FirebaseController::class,'addFunc']);