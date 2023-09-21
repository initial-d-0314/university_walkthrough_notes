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
    Route::get('/university/create','create')->name('university_create');
    Route::get('/university/{university}/edit','edit')->name('university_edit');
    Route::put('/university/{university}','update')->name('university_update');
    Route::get('/university','index')->name('university_index');
    Route::post('/university','store')->name('university_store');

});

Route::controller(GenreCategoryController::class)->middleware(['auth'])->group(function(){
    Route::get('/category/create','create')->name('genrecategory_create');
    Route::get('/category/{category}/edit','edit')->name('genrecategory_edit');
    Route::put('/category/{category}','update')->name('genrecategory_update');
    Route::get('/category','index')->name('genrecategory_index');
    Route::post('/category','store')->name('genrecategory_store');

});

Route::controller(PostCommentController::class)->middleware(['auth'])->group(function(){
    Route::get('/post/create','create')->name('postcomment_create');
    Route::get('/post/{post}/edit','edit')->name('postcomment_edit');
    Route::put('/post/{post}/delete','delete')->name('postcomment_delete');
    Route::get('/post/{post}','show')->name('postcomment_show');
    Route::put('/post/{post}','update')->name('postcomment_update');
    Route::get('/post','index')->name('postcomment_index');
    Route::post('/post','store')->name('postcomment_store');
    //コメント
    Route::put('/post/comment/{post}/{postcomment}/delete','commentdelete')->name('postcomment_commentdelete');
    Route::get('/post/comment/{post}/{postcomment}/edit','commentedit')->name('postcomment_commentedit');
    Route::put('/post/comment/{post}/{postcomment}','commentupdate')->name('postcomment_commentupdate');
    Route::post('/post/comment/','commentstore')->name('postcomment_commentstore');;
    //検索機能
    Route::get('/search/before','search_before')->name('search_before');
    Route::get('/search','search')->name('search_index');
    Route::get('/search/setting','setting_index')->name('setting_index');
    Route::get('/search/setting/add','setting_save')->name('setting_save');
    Route::get('/search/setting/{serachsetting}/delete','setting_delete')->name('setting_delete');;
    //お気に入り、助かった機能
    Route::post('/post/help/add','help')->name('posts.help');
    Route::post('/post/favorite/add','favorite')->name('posts.favorite');
});

Route::controller(UserAdditionalController::class)->middleware(['auth'])->group(function(){
    Route::get('/useradditional/my','index')->name('useradditional_index');
    Route::get('/useradditional/edit','edit')->name('useradditional_edit');
    Route::get('/useradditional/{user}','index_other')->name('useradditional_index_other');
    Route::put('/useradditional/','update')->name('useradditional_update');
    //(対象ユーザーのお気に入り投稿機能を探す)
    Route::get('/useradditional/my/favorite','favorite')->name('useradditional_favorite');
    Route::get('/useradditional/{user}/favorite','favorite_other')->name('useradditional_favorite_other');
});


require __DIR__.'/auth.php';
