<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\TokenRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TokenService
{
    /**
     * @param string $cnpj
     * @param string $password
     *
     * @return string|null
     */
    public static function generateUserToken(string $cnpj, string $password): ?string
    {
        if (!$user = UserRepository::getUserByCnpj($cnpj)) {
            return null;
        }
        if (!Hash::check($password, $user->{User::PASSWORD})) {
            return null;
        }

        $token = Str::random(60);
        while (TokenRepository::getByToken($token)) {
            $token = Str::random(60);
        }
        TokenRepository::create($user->{User::ID}, $token);
        return $token;
    }

    /**
     * @param string $token
     *
     * @return int|null
     */
    public static function getUserIdByToken(string $token): ?int
    {
        return TokenRepository::getUserIdByToken($token);
    }

    /**
     * @return JsonResponse
     */
    public static function unauthorizedResult(): JsonResponse
    {
        return response()->json(
            [
                'message' => 'Unauthorized.'
            ],
            401
        );
    }
}
