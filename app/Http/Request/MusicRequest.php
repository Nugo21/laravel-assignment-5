<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class MusicRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'music_name' => 'nullable|string',
            'music_url' => 'required|string'
        ];
    }
}
