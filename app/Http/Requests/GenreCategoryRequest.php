<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category.genre_id' => 'required|numeric',
            'category.name' => 'required|string|max:100',
            'category.description' => 'required|string|max:100',
        ];
    }
    
        public function attributes()
    {
        return [
            'category.genre_id' => '所属カテゴリ',
            'category.name' => '名前',
            'category.description' => '説明文',
        ];
    }
}
