<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

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
}
