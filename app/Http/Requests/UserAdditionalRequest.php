<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAdditionalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'additional.university_id' => 'sometimes|nullable|numeric',
            'additional.grade' => 'sometimes|nullable|string',
            'additional.section' => 'sometimes|nullable|string|max:100',
            'additional.introduction' => 'sometimes|nullable|string|max:2000'
        ];
    }
    
    public function attributes()
    {
        return [
            'additional.university_id' => '所属大学',
            'additional.grade' => '区分',
            'additional.section' => '所属',
            'additional.introduction' => '自己紹介'
        ];
    }
}
