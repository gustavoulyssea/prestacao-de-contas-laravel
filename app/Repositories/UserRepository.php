<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    /**
     * @param string $cnpj
     *
     * @return Model|null
     */
    public static function getUserByCnpj(string $cnpj): ?Model
    {
        return User::query()->where(User::CNPJ, $cnpj)->first();
    }

    /**
     * @param string $email
     *
     * @return Model|null
     */
    public static function getUserByEmail(string $email): ?Model
    {
        return User::query()->where(User::EMAIL, $email)->first();
    }

    /**
     * @param int $id
     *
     * @return Model|null
     */
    public static function getUserById(int $id): ?Model
    {
        return User::query()->where(User::ID, $id)->first();
    }

    /**
     * @param string $token
     *
     * @return Model|null
     */
    public static function getUserByResetPasswordToken(string $token): ?Model
    {
        return User::query()->where(User::RESET_PASSWORD_TOKEN, $token)->first();
    }

    /**
     * @param array $userData
     *
     * @return int
     */
    public static function create(
        array $userData
    ): int {
        $user = new User();
        foreach ($userData as $key => $value) {
            $user->setAttribute($key, $value);
        }
        $user->{User::PASSWORD} = Hash::make($userData['password']);
        $user->save();
        return $user->{User::ID};
    }
}
