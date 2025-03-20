<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class LoginRequest extends FormRequest
{
    use ResponseTrait;
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
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required' 
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'E-mail é obrigatório.',
            'email.email'       => 'Digite um e-mail válido.',
            'email.exists'      => 'E-mail ou senha inválidos.',
            'password.required' => 'A senha é obrigatória.'
        ];
    }
}
