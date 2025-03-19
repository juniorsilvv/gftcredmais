<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class RegisterRequest extends FormRequest
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
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6'
        ];
    }

    public function messages() : array 
    {
        return [
            'name.required'     => 'O nome é obrigatório,',
            'name.string'       => 'O nome precisa ser uma string.',
            'email.required'    => 'O E-mail é brigatório.',
            'email.email'       => 'Digite um e-mail válido.',
            'email.unique'      => 'E-mail já cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min'      => 'A senha precisa ter pelo menos 6 caracteres'
        ];
    }
}
