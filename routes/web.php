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
    Route::put('/post/{post}/delete','delete');
    Route::get('/post/{post}','show');
    Route::put('/post/{post}','update');
    Route::get('/post','index')->name('postcomment_index');
    Route::post('/post','store');
    //コメント
    Route::put('/post/comment/{post}/{postcomment}/delete','commentdelete');
    Route::get('/post/comment/{post}/{postcomment}/edit','commentedit');
    Route::put('/post/comment/{post}/{postcomment}','commentupdate');
    Route::post('/post/comment/','commentstore');
    //検索機能
    Route::get('/search/before','search_before')->name('search_before');
    Route::get('/search','search')->name('search_index');
    //お気に入り、助かった機能
    Route::post('/post/help/add','help')->name('posts.help');
    Route::post('/post/favorite/add','favorite')->name('posts.favorite');
});

Route::controller(UserAdditionalController::class)->middleware(['auth'])->group(function(){
    Route::get('/useradditional/id/{user}','index_other')->name('useradditional_index_other');
    Route::get('/useradditional/edit','edit');
    Route::get('/useradditional/my','index')->name('useradditional_index');
    Route::put('/useradditional/','update');
    //(対象ユーザーのお気に入り投稿機能を探す)
    Route::get('/useradditional/my/favorite','favorite');
    Route::get('/useradditional/id/{user}/favorite','favorite_other');
});


require __DIR__.'/auth.php';
