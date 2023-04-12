<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'desc' => ['nullable'],
            'type' => ['required','string'],
            'price' => ['required'],
            'stok' => ['required','numeric'],
        ];
    }
}
