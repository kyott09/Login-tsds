<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ----------------------
// Rutas de Autenticación
// ----------------------

// Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// ----------------------
// Rutas protegidas por Auth
// ----------------------
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Tareas
    Route::get('/tareas', [App\Http\Controllers\TareaController::class,'index'])->name('tareas.index');
    Route::get('/tareas/create', [App\Http\Controllers\TareaController::class, 'create'])->name('tareas.create');
    Route::post('/tareas', [App\Http\Controllers\TareaController::class, 'store'])->name('tareas.store');
    Route::get('/tareas/{tarea}/edit', [App\Http\Controllers\TareaController::class, 'edit'])->name('tareas.edit');
    Route::put('/tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'update'])->name('tareas.update');
    Route::delete('/tareas/{tarea}', [App\Http\Controllers\TareaController::class, 'destroy'])->name('tareas.destroy');

    // Perfil de usuario
    Route::get('/perfil', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/perfil', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::delete('/perfil/imagen', [UserController::class, 'deleteProfileImage'])->name('user.deleteProfileImage');
});

// ----------------------
// Rutas Login/Register/Customer
// ----------------------
Route::get('/logincustomer', [App\Http\Controllers\Auth\LoginCustomerController::class, 'showLoginForm'])->name('logincustomer');
Route::post('/logincustomer', [App\Http\Controllers\Auth\LoginCustomerController::class, 'login'])->name('logincustomer.submit');

Route::get('/registercustomer', [App\Http\Controllers\Auth\RegisterCustomerController::class, 'showRegistrationForm'])->name('registercustomer');
Route::post('/registercustomer', [App\Http\Controllers\Auth\RegisterCustomerController::class, 'register'])->name('registercustomer.submit');

// ----------------------
// Calendario
// ----------------------
Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar');

// ----------------------
// Vehículos
// ----------------------
Route::get('/vehiculos', [VehicleController::class, 'index'])->name('vehiculos.index') 
    ->middleware('permission:ver vehiculos');

Route::get('/vehiculos/create', [VehicleController::class, 'create'])->name('vehiculos.create')
    ->middleware('permission:crear vehiculos');

Route::post('/vehiculos', [VehicleController::class, 'store'])->name('vehiculos.store')
    ->middleware('permission:crear vehiculos');

Route::get('/vehiculos/{vehiculo}/edit', [VehicleController::class, 'edit'])->name('vehiculos.edit')
    ->middleware('permission:editar vehiculos');

Route::put('/vehiculos/{vehiculo}', [VehicleController::class, 'update'])->name('vehiculos.update')
    ->middleware('permission:editar vehiculos');

Route::delete('/vehiculos/{vehiculo}', [VehicleController::class, 'destroy'])->name('vehiculos.destroy')
    ->middleware('permission:borrar vehiculos');

// ----------------------
// Empleados
// ----------------------
