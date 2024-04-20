<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSerialChangeRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // Make sure to return true to allow form processing
    }

    public function rules()
    {
        return [
            'old_serial' => 'required|string|max:32',
            'new_serial' => 'required|string|max:32',
            'reason' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'old_serial.required' => 'A jelenlegi serial megadása kötelező.',
            'old_serial.string' => 'A jelenlegi serialnak szövegnek kell lennie.',
            'old_serial.max' => 'A jelenlegi serial legfeljebb 32 karakter hosszú lehet.',
            'new_serial.required' => 'Az új serial megadása kötelező.',
            'new_serial.string' => 'Az új serialnak szövegnek kell lennie.',
            'new_serial.max' => 'Az új serial legfeljebb 32 karakter hosszú lehet.',
            'reason.required' => 'Az indoklás megadása kötelező.',
            'reason.string' => 'Az indoklásnak szövegformátumúnak kell lennie.',
            'reason.max' => 'Az indoklás legfeljebb 255 karakter hosszú lehet.',
        ];
    }
}

