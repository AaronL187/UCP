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
    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'serial' => 'required|string|max:32|min:32',
            'adminlevel' => 'required|integer',
            'adminnickname' => 'nullable|string|max:255',
            'activecharacter' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'A felhasználónév megadása kötelező.',
            'email.required' => 'Az email cím megadása kötelező.',
            'email.email' => 'Az email cím formátuma érvénytelen.',
            'password.min' => 'Az új jelszó legalább :min karakter hosszú kell legyen.',
            'serial.required' => 'A serial megadása kötelező.',
            'serial.string' => 'A serialnak szövegnek kell lennie.',
            'serial.max' => 'A serial szám 32 karakter hosszú kell, hogy legyen!.',
            'serial.min' => 'A serial szám 32 karakter hosszú kell, hogy legyen!.',
            'adminlevel.required' => 'Az adminisztrációs szint megadása kötelező.',
            'adminlevel.integer' => 'Az adminisztrációs szint értéke csak egész szám lehet.',
            'adminnickname.max' => 'Az admin becenév maximum :max karakter hosszú lehet.',
            'activecharacter.integer' => 'Az aktív karakter azonosítója csak egész szám lehet.',
        ];
    }
}
