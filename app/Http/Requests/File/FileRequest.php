<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class FileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'name.string' => 'A name must be a string',
            'name.gte' => 'Name must has gte 1 symbols',
        ];
    }
    
    public function rules(): array
    {
        return [
            'file' => 'file|required|mimes:png,jpg,jpeg,webp,svg|max:5048',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ]));
    }
}
