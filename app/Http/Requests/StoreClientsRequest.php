<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientsRequest extends FormRequest
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
            'Nom' => 'required|string',
            'Prenom' => 'required|string',
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
