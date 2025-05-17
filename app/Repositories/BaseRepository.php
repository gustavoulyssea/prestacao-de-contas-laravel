<?php

namespace App\Repositories;

class BaseRepository
{
    /**
     * @param mixed $result
     *
     * @return array|null
     */
    public static function toArray($result): ?array
    {
        return $result?->toArray();
    }
}
