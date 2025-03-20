<?php

namespace App\Services;

use App\Repositories\CommissionsRepository;

class CommissionsServices
{

    public function __construct(
        public $repository = new CommissionsRepository
    ) {}


    /**
     * Cria a comissão
     *
     * @param $contract
     * @return bool
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function createCommissions($contract): bool
    {
        // Remove todas as comissões existentes para o contrato
        $this->repository->delete($contract->id, 'loan_contract_id');

        // Busca o contrato no banco

        // Calcula e cria a comissão para o gerente comercial
        $this->createCommission($contract->id, $contract->commercial_manager_id, 'commercial', $contract->amount * 0.06);

        // Calcula e cria a comissão para o gerente regional
        $this->createCommission($contract->id, $contract->regional_manager_id, 'regional', $contract->amount * 0.03);

        // Calcula e cria a comissão para o superintendente
        $this->createCommission($contract->id, $contract->superintendent_id, 'superintendent', $contract->amount * 0.01);

        return true;
    }

    /**
     * Cria o registro da comissão do contrato
     *
     * @param string $contractId
     * @param int $userId
     * @param string $role
     * @param float $amount
     * @return void
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    protected function createCommission(string $contractId, int $userId, string $role, float $amount): void
    {
        $this->repository->create([
            'loan_contract_id' => $contractId,
            'user_id' => $userId,
            'role' => $role,
            'amount' => $amount,
        ]);
    }
}
