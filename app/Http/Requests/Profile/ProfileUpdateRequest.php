<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class ProfileUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "string|nullable|min:2|max:18",
            "surname" => "string|nullable|min:2|max:25",
            "patronymic" => "string|nullable|min:2|max:18",
            "status" => "string|nullable|min:2|max:150",
            "age" => "numeric|min:0|max:200",
            "photo" => "file|nullable",
            "email" => "string|email",
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
