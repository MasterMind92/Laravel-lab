<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartementsRequest extends FormRequest
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
            'AppartementID' => 'required|numeric',
            'Code' => 'required|alpha_num:ascii',
            'Type' => 'required|alpha_num:ascii',
            'Surface' => 'required|alpha_num:ascii',
            'Etage' => 'required|numeric',
            'CapaciteMax' => 'required|numeric',
            'Etat' => 'required|alpha_num:ascii|in:A,I',
            'DernierNettoyage' => 'required|date',
            'DateDerniereRenovation' => 'required|date',
            'Observations' => 'required|alpha_num:ascii|max:255|string',
        ];
    }
}
