<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenerateToken extends Controller
{
    public const INPUT_CNPJ = 'cnpj';
    public const INPUT_PASSWORD = 'password';

    /**
     * @group user
     * User related endpoints
     */
    public function __generate_doc()
    {
    }

    /**
     * Generate user token
     *
     * @group user
     *
     * @bodyParam cnpj string required CNPJ
     * @bodyParam password string required password
     *
     * @response scenario=success {
     *   "bearer_token": "tokenabcde",
     *   "validuntil": "1747515969",
     *  }
     *
     * @response status=401 scenario="Invalid CNPJ or password" {"message": "Invalid CNPJ or password"}
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function generateToken(Request $request)
    {
        $cnpj = $request->input(self::INPUT_CNPJ);
        $password = $request->input(self::INPUT_PASSWORD);
        if (!$token = TokenService::generateUserToken($cnpj, $password)) {
            return response()->json(
                ['message' => 'Invalid CNPJ or password'],
                401
            );
        }

        return response()->json(
            [
                'bearer_token' => $token,
                'valid_until' => time() + 86400
            ]
        );
    }
}
