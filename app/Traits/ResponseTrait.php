<?php

namespace App\Traits;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ResponseTrait {


    /**
     * Retorna em JSON os erros nos ocorridos nos REQUETS
     *
     * @param Validator $validator
     * @author Junior <hjuniorbsilva@gmail.com>
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 422));
    }

}