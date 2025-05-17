<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

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
}
