<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /**
     * Reset password
     *
     * @group user
     *
     * @bodyParam hash string required hash
     * @bodyParam password string required password
     *
     *
     * @response scenario=success {
     *     "msg": "Senha resetada com sucesso.",
     *    }
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function post(Request $request): JsonResponse
    {
        $hash = $request->json()->get('hash');
        $password = $request->json()->get('password');
        return UserService::resetPassword($hash, $password);
    }
}
