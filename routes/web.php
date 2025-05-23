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

Route::get('/cars/{carId}/jobs', [CarJobController::class, 'showJobs'])->name('cars/jobs/show');
Route::put('/cars/{carId}/jobs/update', [CarJobController::class, 'updateAllJobs'])->name('cars/jobs/updateAll');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-jobs', [CarJobController::class, 'myJobs'])->name('my/jobs');
    Route::put('/my-jobs/{job}/update-status', [CarJobController::class, 'updateStatus'])->name('my/jobs/updateStatus');
});

Route::get('/admin/users', [CarJobController::class, 'adminUserOverview'])->name('admin/users/index');
Route::get('/admin/car/job-archive', [CarJobController::class, 'jobArchive'])->name('admin/car/jobs/archive');





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
    Route::get('/admin/car/{carId}/jobs/{jobId}/edit', [CarJobController::class, 'edit'])->name('admin/car/jobs/edit');
    Route::put('/admin/car/{carId}/jobs/{jobId}', [CarJobController::class, 'update'])->name('admin/car/jobs/update');
    Route::delete('/admin/car/{carId}/jobs/{jobId}', [CarJobController::class, 'destroy'])->name('admin/car/jobs/destroy');
    Route::get('/admin/job-archive', [CarJobController::class, 'jobArchive'])->name('admin/jobs/archive');

});

require __DIR__.'/auth.php';


