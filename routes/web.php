<?php

use App\Http\Controllers\departmentController;
use App\Http\Controllers\serviceController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $user = DB::table('users')->get();
    // $user = User::all();
    return view('dashboard',compact('user'));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

Route::get('/department/all',[departmentController::class,'index'])->name('department');
Route::post('/depart/add',[departmentController::class,'add_depart'])->name('add_depart');
Route::get('/depart/edit/{id}',[departmentController::class,'edit']);
Route::post('/depart/update',[departmentController::class,'update'])->name('update_depart');
Route::get('/depart/delete/{id}',[departmentController::class,'delete']);
Route::get('/depart/restore/{id}',[departmentController::class,'restore']);
Route::get('/depart/forcedelete/{id}',[departmentController::class,'force_del']);

//page services
Route::get('/services/all',[serviceController::class,'index'])->name('services');
Route::post('/services/add',[serviceController::class,'add'])->name('add_services');
Route::get('/services/edit/{id}',[serviceController::class,'edit']);
Route::post('/services/update',[serviceController::class,'update'])->name('update_services');
Route::get('/services/delete/{id}',[serviceController::class,'delete']);
});
