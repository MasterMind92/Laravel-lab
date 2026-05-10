<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServicesRequest extends FormRequest
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
            'Code' => 'required|max:255|unique:services,Code',
            'Libelle' => 'nullable|max:255',
            'Categorie' => 'nullable|max:255',
            'PrixUnitaire' => 'required|integer|min:0',
            'DureeMoyenne' => 'nullable|max:100',
            'UniteFacturation' => 'required|max:100',
        ];
    }
}
