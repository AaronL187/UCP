<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNameChangeRequest extends FormRequest
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
            'character_id' => 'integer|exists:characters,id',
            'new_name' => [
                'required',
                'string',
                'max:255',
                'different:old_name',
                'regex:/\s/',
            ],
            'reason' => 'required|string',
            'handled_by' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1',
        ];
    }
    public function messages(): array
    {
        return [
            'character_id.integer' => 'A karakter azonosítónak egész számnak kell lennie.',
            'character_id.exists' => 'A megadott karakter azonosító nem létezik.',
            'old_name.string' => 'A régi névnek szöveg típusúnak kell lennie.',
            'old_name.max' => 'A régi név legfeljebb 255 karakter hosszú lehet.',
            'new_name.required' => 'Az új név megadása kötelező.',
            'new_name.string' => 'Az új névnek szöveg típusúnak kell lennie.',
            'new_name.max' => 'Az új név legfeljebb 255 karakter hosszú lehet.',
            'new_name.different' => 'Az új névnek különböznie kell a régitől.',
            'reason.required' => 'Az indoklás megadása kötelező.',
            'reason.string' => 'Az indoklásnak szöveg típusúnak kell lennie.',
            'handled_by.string' => 'A kezelő neve szöveg típusúnak kell lennie.',
            'status.integer' => 'A státusznak egész számnak kell lennie.',
            'status.in' => 'A státusznak 0 vagy 1 értékűnek kell lennie.',
            'new_name.regex' => 'A nevet spacekkel kell elválasztani!',
        ];
    }

}
