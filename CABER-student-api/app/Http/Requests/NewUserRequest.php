<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
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
    public function rules()
    {  
        return [
            'firstName' => 'required|string|max:255',
            'lastnNme'  => 'required|string|max:255',
            'age'       => 'required|integer|min:0',
            'nickname'  => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'firstName.required' => 'Input First Name!',
            'lastName.required' => 'Input Last Name!',
            'age.required' => 'Input Age!',
            'nickname.required' => 'Input Nickname!',
        ];
    }
}
