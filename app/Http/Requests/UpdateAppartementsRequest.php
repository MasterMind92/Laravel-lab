<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAppartementsRequest extends FormRequest
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
            'Code' => 'required|alpha_dash:ascii|',
            'Type' => [
                'required',
                Rule::string()
                    ->min(3)
                    ->max(255)
            ],
            'Surface' => 'required|alpha_dash:ascii|',
            'Etage' => 'required|numeric',
            'CapaciteMax' => 'required|numeric',
            'Etat' => [
                'required',
                'in:Disponible,Occupe,Maintenance',
                Rule::string()
                    ->min(3)
                    ->max(12)
                ],
            'DernierNettoyage' => 'required|date',
            'DateDerniereRenovation' => 'required|date',
            'Observations' => 'required|max:255|string',
        ];
    }
}
