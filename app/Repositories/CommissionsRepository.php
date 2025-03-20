<?php

namespace App\Repositories;

use App\Models\Commissions;

class CommissionsRepository extends Repository
{

    public function __construct()
    {
        // Definindo o modelo (Model) a ser usado no repositório
        $this->model = Commissions::class;
    }
}