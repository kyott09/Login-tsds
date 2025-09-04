<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware(['auth'])->group(function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tareas',[App\Http\Controllers\TareaController::class,'index'])->name('tareas.index');

Route::get('/tareas/create',[App\Http\Controllers\TareaController::class, 'create'])->name('tareas.create');

Route::post('/tareas',[App\Http\Controllers\TareaController::class, 'store'])->name('tareas.store');

Route::get('/tareas/{tarea}/edit',[App\Http\Controllers\TareaController::class, 'edit'])->name('tareas.edit');

Route::put('/tareas/{tarea}',[App\Http\Controllers\TareaController::class, 'update'])->name('tareas.update');

Route::delete('/tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'destroy'])->name('tareas.destroy');

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

});

Route::get('/logincustomer', [App\Http\Controllers\Auth\LoginCustomerController::class, 'showLoginForm'])->name('logincustomer');

Route::post('/logincustomer', [App\Http\Controllers\Auth\LoginCustomerController::class, 'login'])->name('logincustomer.submit');

// Rutas para Registro de Clientes
Route::get('/registercustomer', [App\Http\Controllers\Auth\RegisterCustomerController::class, 'showRegistrationForm'])->name('registercustomer');
Route::post('/registercustomer', [App\Http\Controllers\Auth\RegisterCustomerController::class, 'register'])->name('registercustomer.submit');
