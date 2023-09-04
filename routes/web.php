<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UniversityController;
use App\Http\Controllers\GenreCategoryController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\UserAdditionalController;
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
    Route::put('/university/{university}','update');
    Route::get('/university','index')->name('university_index');
    Route::post('/university','store');

});

Route::controller(GenreCategoryController::class)->middleware(['auth'])->group(function(){
    Route::get('/category/create','create');
    Route::get('/category/{category}/edit','edit');
    Route::put('/category/{category}','update');
    Route::get('/category','index')->name('genrecategory_index');
    Route::post('/category','store');

});

Route::controller(PostCommentController::class)->middleware(['auth'])->group(function(){
    Route::get('/post/create','create');
    Route::get('/post/{post}/edit','edit');
    Route::get('/post/{post}','show');
    Route::put('/post/{post}','update');
    Route::get('/post','index')->name('postcomment_index');
    Route::post('/post','store');
    //コメント
    Route::put('/post/comment/{post}/{postcomment}/delete','commentdelete');
    Route::get('/post/comment/{post}/{postcomment}/edit','commentedit');
    Route::put('/post/comment/{post}/{postcomment}','commentupdate');
    Route::post('/post/comment/','commentstore');
});

Route::controller(UserAdditionalController::class)->middleware(['auth'])->group(function(){
    Route::get('/useradditional/edit','edit');
    Route::put('/useradditional/','update');
    //Route::put('/useradditional/','update');(ユーザー個人ページとお気に入りと)
});


require __DIR__.'/auth.php';
