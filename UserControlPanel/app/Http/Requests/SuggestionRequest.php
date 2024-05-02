<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SuggestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'suggested_by' => 'integer|exists:users,id',
            'suggestion' => 'string|max:1000',
            'status' => 'nullable|boolean',
            'handled_by' => 'nullable|integer|exists:users,id',
            'reason' => 'nullable|string|max:500',
            'reward' => 'nullable|integer|min:0'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'suggested_by.required' => 'A javaslattevő megadása kötelező.',
            'suggested_by.integer' => 'A javaslattevő azonosítónak egész számnak kell lennie.',
            'suggested_by.exists' => 'A megadott javaslattevő nem létezik az adatbázisban.',
            'suggestion.required' => 'A javaslat szövege nem lehet üres.',
            'suggestion.string' => 'A javaslat szövege szöveges formátumú kell, hogy legyen.',
            'suggestion.max' => 'A javaslat nem lehet hosszabb 1000 karakternél.',
            'status.boolean' => 'Az állapot csak igaz vagy hamis lehet.',
            'handled_by.integer' => 'A kezelő azonosítónak egész számnak kell lennie.',
            'handled_by.exists' => 'A megadott kezelő nem létezik az adatbázisban.',
            'reason.string' => 'A döntés indoka szöveges formátumú kell, hogy legyen.',
            'reason.max' => 'A döntés indoka nem lehet hosszabb 500 karakternél.',
            'reward.integer' => 'A jutalom egész szám kell, hogy legyen.',
            'reward.min' => 'A jutalom nem lehet negatív.'
        ];
    }
}
