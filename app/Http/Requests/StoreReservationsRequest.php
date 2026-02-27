<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationsRequest extends FormRequest
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
            'Numero' => 'required|alpha_num:ascii',
            'DateArrivee' => 'required|date',
            'DateDepart' => 'required|date',
            'NbAdultes' => 'required|numeric|lt:5',
            'NbEnfants' => 'required|numeric|lt:5',
            'Statut' => 'required|string|',
            'fkClient' => 'required|numeric',
            'fkAppart' => 'required|numeric',
            'Source' => 'required|string',
            'Notes' => 'required|numeric',
        ];
    }
}
