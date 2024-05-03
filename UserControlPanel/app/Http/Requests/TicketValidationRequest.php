<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TicketValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'ticket_by' => 'integer',  // Assuming 'users' table has 'id'
            'problem' => 'string|max:1000',
            'status' => 'nullable|boolean',
            'handled_by' => 'nullable|integer',  // Assuming 'users' table has 'id'
            'reason' => 'nullable|string|max:1000', // Assuming a reasonable maximum length for a reason
            'handled_at' => 'nullable|date',
            'reward' => 'integer|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ticket_by.integer' => 'A jegy beküldőjének azonosítója számnak kell lennie.',
            'problem.required' => 'A probléma leírása kötelező.',
            'problem.max' => 'A probléma leírása nem lehet hosszabb 1000 karakternél.',
            'status.boolean' => 'Az állapot értéke csak igaz vagy hamis lehet.',
            'handled_by.integer' => 'A kezelő azonosítójának számnak kell lennie.',
            'reason.max' => 'Az indoklás nem lehet hosszabb 1000 karakternél.',
            'handled_at.date' => 'A kezelés dátuma nem érvényes dátumformátum.',
            'reward.integer' => 'A jutalomnak számnak kell lennie.',
            'reward.min' => 'A jutalom nem lehet negatív.',
        ];
    }
}
