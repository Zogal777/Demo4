<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->id === 1; // только админ
    }

    public function rules(): array
    {
        $userId = $this->route('id'); // ID пользователя из маршрута

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'date_of_birth' => ['required', 'date'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
