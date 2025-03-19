<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;

class ContractRequest extends FormRequest
{
    use ResponseTrait;


    public function prepareForValidation()
    {

        /**
         * Se existir o parametro na url, adiciona no array dos dados para o form request validar
         */
        if (!empty($this->route('uuid'))) 
            $this->merge(['uuid' => $this->route('uuid')]);
        
    }


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
     */
    public function rules()
    {
        /**
         * Caso seja method get, valida se o uuid existe
         */
        if($this->isMethod('get'))
            return array_merge($this->uuid());


        /**
         * Caso seja o method post para a criação de um novo contrato, utiliza essas validações
         */
        if ($this->isMethod('post')) 
            return array_merge(
                $this->clientId(),
                $this->amount(),
                $this->commercialManagaerId(),
                $this->regionalManagerId(),
                $this->superintendentId(),
                $this->status()
            );
        
        /**
         * Caso seja o method put para alteração do contrato, utiliza essas validações
         */
        if($this->isMethod('put'))
            return array_merge(
                $this->uuid(),
                $this->clientId($this->route('id')),
                $this->amount($this->route('id')),
                $this->commercialManagaerId($this->route('id')),
                $this->regionalManagerId($this->route('id')),
                $this->superintendentId($this->route('id')),
                $this->status($this->route('id'))
            );


        /**
         * Caso seja para deletar um contrato, entra nessa validação
         */
        if($this->isMethod('delete'))
            return array_merge($this->uuid());
    }


    private function clientId()
    {
        return ['client_id' => 'required|integer|exists:users,id'];
    }

    private function amount()
    {
        return ['amount' => 'required|numeric|min:0.01',];
    }

    private function commercialManagaerId()
    {
        return ['commercial_manager_id' => 'required|integer|exists:users,id'];
    }

    private function regionalManagerId()
    {
        return ['superintendent_id' => 'required|integer|exists:users,id'];
    }

    private function superintendentId()
    {
        return ['superintendent_id' => 'required|integer|exists:users,id'];
    }

    private function status()
    {
        return ['status' => 'required|string|in:pending,approved,rejected'];
    }

    private function uuid()
    {
        return ['uuid' => 'required|uuid|exists:loan_contracts,id'];
    }


    public function messages() : array
    {
        return [
            'client_id.required'                => 'ID do cliente é obrigátorio.',
            'client_id.integer'                 => 'ID do cliente precisa ser um numéro inteiro.',
            'client_id.exists'                  => 'Cliente não encontrado.',
            'amount.required'                   => 'O valor é obrigatório.',
            'amount.numeric'                    => 'O valor deve ser um número válido.',
            'amount.min'                        => 'O valor deve ser no mínimo 0.01.',
            'commercial_manager_id.required'    => 'O ID do gerente comercial é obrigatório.',
            'commercial_manager_id.integer'     => 'O ID do gerente comercial precisa ser um número inteiro.',
            'commercial_manager_id.exists'      => 'Gerente comercial não encontrado.',
            'regional_manager_id.required'      => 'O ID do gerente regional é obrigatório.',
            'regional_manager_id.integer'       => 'O ID do gerente regional precisa ser um número inteiro.',
            'regional_manager_id.exists'        => 'Gerente regional não encontrado.',
            'superintendent_id.required'        => 'O ID do superintendente é obrigatório.',
            'superintendent_id.integer'         => 'O ID do superintendente precisa ser um número inteiro.',
            'superintendent_id.exists'          => 'Superintendente não encontrado.',
            'status.required'                   => 'O status é obrigatório.',
            'status.string'                     => 'O status precisa ser uma string.',
            'status.in'                         => 'O status precisa ser um dos seguintes valores: :values.',

            'uuid.required'                     => 'O ID do contrato é obrigatório.',
            'uuid.uuid'                         => 'O id do contrato precisa ser no padrão UUID.',
            'uuid.exists'                       => 'Contrato não encontrado.'
        ];
    }
}
