<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ContractsResource;
use App\Repositories\LoanContractsRepository;

class ContractsController extends Controller
{

    public function __construct(
        public $reposiory = new LoanContractsRepository
    ) {}

    /**
     * Retorna todos os contratos
     *
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function all() : object
    {
        $contracts = $this->reposiory->paginate();
        return new ContractsResource($contracts);
    }
}
