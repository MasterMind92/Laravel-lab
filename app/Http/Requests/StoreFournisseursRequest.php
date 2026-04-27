<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFournisseursRequest extends FormRequest
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
            'Nom' => 'required|max:255',
            'Type' => 'nullable|max:100',
            'Contact' => 'nullable|max:255',
            'Telephone' => 'required|max:50',
            'Email' => 'nullable|email|max:255',
            'Adresse' => 'nullable|max:255',
            'Etat' => 'required|max:50',
        ];
    }
}
