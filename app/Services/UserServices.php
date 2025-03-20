<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class UserServices
{
    /**
     * Verifica o usuário na api do jsonplaceholder
     *
     * @param int $userId
     * @return array
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function getUser(int $userId) : array
    {
        try {
            // Faz a requisição para a API
            $response = Http::timeout(5)->get("https://jsonplaceholder.typicode.com/users/{$userId}");

            // Verifica se o usuário foi encontrado
            if ($response->failed()) 
                return [
                    'error'  => true,
                    'status' => $response->status(),
                    'message' => 'Usuário não encontrado',
                    'data'   => []
                ];

            return [
                'error'  => false,
                'status' => 200,
                'message' => 'Usuário encontrado',
                'data'   => $response->json()
            ];

        } catch (RequestException $e) {
            return [
                'error'   => true,
                'status'  => 500,
                'message' => 'Erro ao conectar na API',
                'data'    => []
            ];        
        }
    }
}