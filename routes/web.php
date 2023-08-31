<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UniversityController;
use App\Http\Controllers\GenreCategoryController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(UniversityController::class)->middleware(['auth'])->group(function(){
    Route::get('/university/create','create');
    Route::get('/university/{university}/edit','edit');
    Route::get('/university','index')->name('university_index');
    Route::post('/university','store');
    Route::put('/university','update');
});

Route::controller(GenreCategoryController::class)->middleware(['auth'])->group(function(){
    Route::get('/category/create','create');
    Route::get('/category/{category}/edit','edit');
    Route::get('/category','index')->name('genrecategory_index');
    Route::post('/category','store');
    Route::put('/category','update');
});
require __DIR__.'/auth.php';
