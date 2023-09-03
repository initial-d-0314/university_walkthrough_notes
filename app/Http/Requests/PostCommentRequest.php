<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'comment.title' => 'required|string|max:100',
            'comment.body' => 'required|string|max:1000',
        ];
    }
}
