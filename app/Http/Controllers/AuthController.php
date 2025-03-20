<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{

    public function __construct(
        public $repository = new UserRepository
    ) {}

    /**
     * Realiza login de um usuário
     *
     * @param LoginRequest $request
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function login(LoginRequest $request): object
    {

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials))
            return response()->json([
                'message' => 'E-mail ou senha inválidos'
            ], 401);

        $user = JWTAuth::user();
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'token' => $token,
            'user'  => $user,
        ]);
    }

    /**
     * Registra um novo usuário
     *
     * @param RegisterRequest $request
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function register(RegisterRequest $request): object
    {

        try {
            $user = $this->repository->create([
                'email'     => $request->email,
                'name'      => ucwords($request->name),
                'password'  => $request->password,
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'token' => $token,
                'user'  => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'Error ao tentar cadastrar usuário.'
            ], 400);
        }
    }


    /**
     * Função para realizar logout
     *
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function logout() :object
    {
        try {
            // Invalida o token do usuário atual
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Logou realizado com sucesso.']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Falha ao realizar logout.'], 500);

        }
    }

    /**
     * Atualiza o token JWT
     *
     * @return object
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function refreshToken(): object
    {
        try {
            $newToken = JWTAuth::refresh();

            return response()->json([
                'token' => $newToken,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Não foi possível atualizar o token'], 401);
        }
    }
}
