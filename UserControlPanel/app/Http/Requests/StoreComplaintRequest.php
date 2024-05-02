<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Csak bejelentkezett felhasználóknak engedélyezzük a panasz beküldését
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'complained_against' => 'required|numeric',
            'description' => 'required|string|min:10',
            'prooflink' => 'nullable',
            'messages' => 'nullable',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A panaszhoz cím szükséges.',
            'complained_against.required' => 'Meg kell adnia a panaszolt játékost.',
            'complained_against.numeric' => 'A panaszolt játékos azonosítója érvényes szám kell legyen.',
            'description.required' => 'Kérjük, adjon meg részletes leírást a panaszról.',
            'prooflink.url' => 'A bizonyíték hivatkozásnak érvényes URL-nek kell lennie.',
        ];
    }
}

