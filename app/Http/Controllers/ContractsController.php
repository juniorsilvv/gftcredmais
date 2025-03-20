<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\ContractRequest;
use App\Http\Resources\ContractsResource;
use App\Repositories\LoanContractsRepository;
use App\Services\CommissionsServices;

class ContractsController extends Controller
{

    public function __construct(
        public $repository = new LoanContractsRepository
    ) {}


    /**
     * Retorna os dados de um contrato especifico
     *
     * @param ContractRequest $request
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function get(ContractRequest $request): object
    {
        $contract = $this->repository->find($request->uuid, ['*'], ['commercialManager', 'regionalManager', 'superintendent']);
        return new ContractsResource($contract);
    }

    /**
     * Retorna todos os contratos
     *
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function all(): object
    {
        $contracts = $this->repository->paginate(10, ['*'], ['commercialManager', 'regionalManager', 'superintendent']);
        return new ContractsResource($contracts);
    }

    /**
     * Cria um novo contrato
     *
     * @param ContractRequest $request
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function create(ContractRequest $request, CommissionsServices $commissions): object
    {

        try {
            $contract = $this->repository->create([
                'client_id'             => $request->client_id,
                'amount'                => $request->amount,
                'commercial_manager_id' => $request->commercial_manager_id,
                'regional_manager_id'   => $request->regional_manager_id,
                'superintendent_id'     => $request->superintendent_id,
                'status'                => $request->status
            ]);

            /** Gerando as comissões */
            $commissions->createCommissions($contract);
            return response()->json([
                'message' => 'Contrato criado com sucesso'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Atualiza os dados de um contrato
     *
     * @param ContractRequest $request
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function update(ContractRequest $request, CommissionsServices $commissions): object
    {
        try {
            $this->repository->update($request->uuid, [
                'client_id'             => $request->client_id,
                'amount'                => $request->amount,
                'commercial_manager_id' => $request->commercial_manager_id,
                'regional_manager_id'   => $request->regional_manager_id,
                'superintendent_id'     => $request->superintendent_id,
                'status'                => $request->status
            ]);

            /**Gerando as comissões */
            $commissions->createCommissions($request->uuid);

            return response()->noContent();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar contrato.'
            ], 500);
        }
    }

    /**
     * Remove um contrato
     *
     * @param ContractRequest $request
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function delete(ContractRequest $request): object
    {
        try {
            $this->repository->delete($request->uuid);

            return response()->json([
                'message' => 'Contrato deletado com sucesso.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar contrato.'
            ], 500);
        }
    }
}
