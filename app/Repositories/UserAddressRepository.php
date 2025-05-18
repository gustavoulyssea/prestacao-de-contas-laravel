<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Model;

class UserAddressRepository extends BaseRepository
{
    /**
     * @param int $userId
     *
     * @return Model|null
     */
    public static function getByUserId(int $userId): ?Model
    {
        return UserAddress::query()->where(UserAddress::USER_ID, $userId)->first();
    }
}
