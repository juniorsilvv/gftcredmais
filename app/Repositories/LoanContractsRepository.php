<?php

namespace App\Repositories;

use App\Models\LoanContracts;

class LoanContractsRepository extends Repository
{

    public function __construct()
    {
        // Definindo o modelo (Model) a ser usado no repositório
        $this->model = LoanContracts::class;
    }
}