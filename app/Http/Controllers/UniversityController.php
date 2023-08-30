<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UniversityRequest;
use App\Models\University;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Cloudinary;  //dev4_画像アップロード

class UniversityController extends Controller
{
    public function index(University $university)
    {
        return view('university.index')->with([
            'universities' => $university->get()
        ]);
    }
        
    public function create(University $university)
    {
        return view('university.create')->with([
            'universities' => $university->get()]);
    }
    
    public function edit(University $university)
    {
        return view('university.edit')->with(['university' => $university]);
    }
    
    public function store(UniversityRequest $request,University $university)
    {
        $input = $request['university'];
        $university->fill($input)->save();
        //saveした時点でidとか日時とかが割り振られている
        return redirect('/university');
    }
    
    public function update(UniversityRequest $request,University $university)
    {
        $input_university = $request['university'];
        $university->fill($input_university)->save();
        //今回は事前に$Postの中身が存在するのでその中身の変更だけにとどまる
        //updateでなくsaveを利用すれば変更がない場合にDBにアクセスしないという利点がある
        return redirect('/university');
    }
}
