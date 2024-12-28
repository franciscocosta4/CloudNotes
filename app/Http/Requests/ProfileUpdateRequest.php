<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            //? FOI ADICIONADO PARA QUE SEJA POSSIVEL ATUALIZAR OS DADOS DO  PERFIL
            'school_year' => ['nullable', 'integer', 'between:7,12'],
            'subjects_of_interest' => ['nullable', 'array'],
            'subjects_of_interest.*' => ['string', 'in:Matemática,Física,Química,Biologia,Português,História,Geografia,Inglês'],
        ];
    }
}
