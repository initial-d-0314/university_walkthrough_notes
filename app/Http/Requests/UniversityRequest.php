<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'university.name' => 'required|string|max:100',
            'university.section' => 'sometimes|nullable|string|max:100',
            'university.address' => 'sometimes|nullable|string|max:100',
            'university.url' => 'sometimes|nullable|url|max:300',
            'university.nearest_station' => 'sometimes|nullable|string|max:100',
        ];
    }
}
