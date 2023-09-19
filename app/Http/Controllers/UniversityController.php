<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UniversityRequest;
use App\Models\University;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UniversityController extends Controller
{
    /*
    *大学の情報を管理する
    */
    
    public function index(University $university)
    {
        return view('university.index')->with([
            'universities' => $university->get()
        ]);
    }
        
    public function create(University $university)
    {
        return view('university.create');
    }
    
    public function edit(University $university)
    {
        return view('university.edit')->with(['university' => $university]);
    }
    
    public function store(UniversityRequest $request,University $university)
    {
        $input = $request['university'];
        $university->fill($input)->save();
        return redirect('/university');
    }
    
    public function update(UniversityRequest $request,University $university)
    {
        $input_university = $request['university'];
        $university->fill($input_university)->save();
        return redirect('/university');
    }
}
