<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'userid' => 'sometimes|nullable|numeric',
            'keyword' => 'sometimes|nullable|string',
        ];
    }
        public function attributes()
    {
        return [
            'userid' => 'ユーザーid',
            'keyword' => 'キーワード',
        ];
    }
}
