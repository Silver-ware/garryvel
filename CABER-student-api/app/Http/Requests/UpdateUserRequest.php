<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'sometimes|string|max:255',
            'lastName' => 'sometimes|string|max:255',
            'age' => 'sometimes|integer|min:18',
            'nickname' => 'sometimes|string|max:255'
        ];
    }
    public function messages()
    {
        return [
            'firstName.string' => 'Input a valid First Name!',
            'lastName.string' => 'Input a valid Last Name!',
            'age.integer' => 'Input a Legal Age',
            'nickname.string' => 'Input a valid Nickname!',
        ];
    }
}
