<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = optional(auth()->user())->id;

        return [
            'login' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'password' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'surname' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', Rule::unique('users')->ignore($userId)],
        ];
    }
}
