<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Retorna todos os registros
     *
     * @param array $columns
     * @param array $relations
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function all($columns = ['*'], $relations = []);

    /**
     * Busca registro especifico
     *
     * @param [type] $id
     * @param array $columns
     * @param array $relations
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function find($id, $columns = ['*'], $relations = []);

    /**
     * Retorna os dados com paginação
     *
     * @param int $perPage
     * @param array $columns
     * @param array $relations
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function paginate($perPage = 10, $columns = ['*'], $relations = []);

    /**
     * Cria um novo registro
     *
     * @param array $data
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function create(array $data);

    /**
     * Atualiza um registro já existente
     *
     * @param [type] $id
     * @param array $data
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function update($id, array $data);

    /**
     * Remove um registro
     *
     * @param [type] $id
     * @param string $column
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function delete($id, $column = 'id');
}