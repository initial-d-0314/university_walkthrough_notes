<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GenreCategoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Genre;
use App\Models\Category;

class GenreCategoryController extends Controller
{
    //ジャンルとカテゴリについて管理する
    //ジャンルは事前に決められた7種類
    //Categoryが編集と追加を考える下位分類なので注意

    /*
    *ジャンルとカテゴリ一覧画面を表示する
    * @params null
    * @return genre_category.index
    */
    public function create(Category $category,Genre $genre)
    {
        return view('genre_category.create')->with([
            'genres'=>$genre->get(),
        ]);
    }

    public function index(Category $category,Genre $genre)
    {
        return view('genre_category.index')->with([
            'categories'=>$category->get(),
            'genres'=>$genre->get(),
        ]);
    }
        
    public function edit(Category $category,Genre $genre)
    {
        return view('genre_category.edit')->with([
            'genres'=>$genre->get(),
            'category' => $category,
        ]);
    }
    
    public function store(GenreCategoryRequest $request,Category $category)
    {
        $input = $request['category'];
        $category->fill($input)->save();
        //saveした時点でidとか日時とかが割り振られている
        return redirect('/category');
    }
    
    public function update(GenreCategoryRequest $request,Category $category)
    {
        $input_category = $request['category'];
        $category->fill($input_category)->save();
        //今回は事前に$Postの中身が存在するのでその中身の変更だけにとどまる
        //updateでなくsaveを利用すれば変更がない場合にDBにアクセスしないという利点がある
        return redirect('/category');
    }
}
