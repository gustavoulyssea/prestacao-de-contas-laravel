<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\UserToken;
use Illuminate\Database\Eloquent\Model;

class TokenRepository extends BaseRepository
{
    /**
     * @param string $token
     *
     * @return Model|null
     */
    public static function getByToken(string $token): ?Model
    {
        $tokenHash = hash('sha256', $token);
        return UserToken::query()->where(UserToken::TOKEN_HASH, $tokenHash)->first();
    }

    /**
     * @param string $userId
     * @param string $token
     *
     * @return Model
     */
    public static function create(int $userId, string $token): Model
    {
        $tokenHash = hash('sha256', $token);
        $token = new UserToken();
        $token->{UserToken::USER_ID} = $userId;
        $token->{UserToken::TOKEN_HASH} = $tokenHash;
        $token->save();
        return $token;
    }

    /**
     * @param string $token
     *
     * @return int|null
     */
    public static function getUserIdByToken(string $token): ?int
    {
        $tokenHash = hash('sha256', $token);
        return UserToken::query()->where(UserToken::TOKEN_HASH, $tokenHash)->first()?->{UserToken::USER_ID};
    }
}
