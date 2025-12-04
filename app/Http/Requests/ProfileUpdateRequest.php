<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
//                Rule::unique('users')->ignore($this->route('id')),
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'date_of_birth' => ['required', 'date'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
