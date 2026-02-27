<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ClientID' => 'required|numeric',
            'Nom' => 'required|string|alpha_num:ascii',
            'Prenom' => 'required|string|alpha_num:ascii',
            'Email' => 'required|email:rfc,dns',
            'Telephone' => 'required|alpha_num:ascii|min:8',
            'Adresse' => 'required|alpha_num:ascii',
            'DateNaissance' => 'required|date',
            'TypeClient' => 'required|alpha_num:ascii',
            'Statut' => 'required|string|alpha_num:ascii',
            'PointsFidelite' => 'required|numeric',
        ];
    }
}
