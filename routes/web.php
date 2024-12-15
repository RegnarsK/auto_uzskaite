<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarJobController;
use App\Models\Car;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    $cars = Car::all(); 
    return view('dashboard', compact('cars'));
})->middleware(['auth'])->name('dashboard');





Route::middleware(['auth', 'admin'])->group(function () {
 
    Route::get('admin/dashboard', [HomeController::class, 'index']);
    //masinas
    Route::get('/admin/cars', [CarController::class, 'index'])->name('admin/cars');
    Route::get('/admin/cars/create', [CarController::class, 'create'])->name('admin/cars/create');
    Route::post('/admin/cars/store', [CarController::class, 'store'])->name('admin/cars/store');
    Route::get('/admin/cars/edit/{id}', [CarController::class, 'edit'])->name('admin/cars/edit');
    Route::put('/admin/cars/edit/{id}', [CarController::class, 'update'])->name('admin/cars/update');
    Route::get('/admin/cars/delete/{id}', [CarController::class, 'delete'])->name('admin/cars/delete');
    Route::get('/admin/cars/{id}', [CarController::class, 'show'])->name('admin/cars/show');

    //darbi
    Route::get('/admin/cars/{carId}/jobs/create', [CarJobController::class, 'create'])->name('admin/cars/jobs/create');
    Route::post('/admin/car/{carId}/jobs/store', [CarJobController::class, 'store'])->name('admin/car/jobs/store');

});

require __DIR__.'/auth.php';


