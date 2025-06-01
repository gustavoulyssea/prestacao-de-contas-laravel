<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param array $userData
     *
     * @return array|int
     */
    public static function create(
        array $userData
    ): array|int {

        if (empty($userData['email']) || UserRepository::getUserByEmail($userData['email'])) {
            return [
                'field' => 'email',
                'message' => 'Email already registered'
            ];
        }

        if (empty($userData['cnpj']) || UserRepository::getUserByCnpj($userData['cnpj'])) {
            return [
                'field' => 'cnpj',
                'message' => 'CNPJ already registered'
            ];
        }

        return UserRepository::create($userData);
    }

    /**
     * @param string $hash
     * @param string $password
     *
     * @return JsonResponse
     */
    public static function resetPassword(string $hash, string $password): JsonResponse
    {
        if (!$password) {
            return response()->json(
                [
                    'msg' => 'Senha inválida.'
                ]
            )->setStatusCode(400);
        }

        if (!$hash || !$customer = UserRepository::getUserByResetPasswordToken($hash)) {
            return response()->json(
                [
                    'msg' => 'Link inválido.'
                ]
            )->setStatusCode(400);
        }

        $customer->{USER::RESET_PASSWORD_TOKEN} = md5(uniqid() . rand(1000000, 9999999));
        $customer->{User::PASSWORD} = Hash::make($password);
        $customer->save();

        return response()->json(
            [
                'msg' => 'Sua senha foi alterada.'
            ]
        );
    }
}
