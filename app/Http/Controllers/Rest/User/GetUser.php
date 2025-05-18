<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Repositories\UserAddressRepository;
use App\Repositories\UserRepository;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetUser extends Controller
{
    /**
     * Get logged-in user details
     *
     * @group user
     *
     * @authenticated
     *
     * @response scenario=success {
     *      "id": 1,
     *      "name": "Nome completo",
     *      "email": "teste@email.com",
     *      "cnpj": "123546789",
     *      "razao_social": "Razao social",
     *      "responsible_name": "Nome",
     *      "telephone": "123456789",
     *      "address": null
     * }
     *
     * @response status=401 scenario="Unautorized" {"message": "Unauthorized"}
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function get(Request $request): JsonResponse
    {
        if (!$userId = TokenService::getUserIdByToken((string) $request->bearerToken())) {
            return TokenService::unauthorizedResult();
        }
        $user = UserRepository::toArray(UserRepository::getUserById($userId));
        $user = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'cnpj' => $user['cnpj'],
            'razao_social' => $user['razao_social'],
            'responsible_name' => $user['responsible_name'],
            'telephone' => $user['telephone'],
        ];
        $user['address'] = UserAddressRepository::toArray(UserAddressRepository::getByUserId($userId));
        return response()->json($user);
    }
}
