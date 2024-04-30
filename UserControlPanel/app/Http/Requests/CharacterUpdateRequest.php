<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterUpdateRequest extends FormRequest
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
            'charactername' => 'required|string|max:255',
            'health' => 'required|numeric|min:0',
            'armor' => 'required|numeric|min:0',
            'hunger' => 'required|numeric|min:0|max:100',
            'thirst' => 'required|numeric|min:0|max:100',
            'money' => 'required|numeric|min:0',
            'pp' => 'required|numeric|min:0',
            'skin_id' => 'required|numeric|min:1',
            'maxvehs' => 'required|numeric|min:0',
            'maxinteriors' => 'required|numeric|min:0',
            'faction_id' => 'nullable|numeric'
        ];
    }
    public function messages()
    {
        return [
            'charactername.required' => 'A karakter neve kötelező.',
            'health.required' => 'Az életerő megadása kötelező.',
            'armor.required' => 'A páncél értéke kötelező.',
            'hunger.required' => 'Az éhség értéke kötelező.',
            'thirst.required' => 'A szomjúság értéke kötelező.',
            'money.required' => 'A pénz mennyiségének megadása kötelező.',
            'pp.required' => 'A prémium pontok megadása kötelező.',
            'skin_id.required' => 'A ruházat azonosítója kötelező.',
            'maxvehs.required' => 'A járművek maximális száma kötelező.',
            'maxinteriors.required' => 'A házak maximális száma kötelező.',
            'faction_id.numeric' => 'A frakció azonosítónak számnak kell lennie.',
            // More custom messages can be added as needed
        ];
    }
}
