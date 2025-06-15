<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\UserFile;
use Illuminate\Database\Eloquent\Model;

class UserFileRepository extends BaseRepository
{
    /**
     * @param int $userId
     * @param string $type
     *
     * @return string|null
     */
    public static function getFileNameByUserIdAndType(int $userId, string $type): ?string
    {
        return UserFile::query()
            ->where(UserFile::USER_ID, $userId)
            ->where(UserFile::FILE_TYPE, $type)
            ->first()?->{UserFile::FILE_NAME};
    }

    /**
     * @param string $name
     *
     * @return Model|null
     */
    public static function getFileByName(string $name): ?Model
    {
        return  UserFile::query()->where(UserFile::FILE_NAME, $name)->first();
    }

    /**
     * @param int $userId
     * @param string $type
     *
     * @return void
     */
    public static function invalidateFilesByCustomerAndType(int $userId, string $type): void
    {
        UserFile::query()->where(UserFile::USER_ID, $userId)
            ->where(UserFile::FILE_TYPE, $type)
            ->update([UserFile::ACTIVE => 0]);
    }

    public static function createFile(int $userId, string $type, string $fileName): int
    {
        return UserFile::query()->insertGetId(
            [
                UserFile::USER_ID => $userId,
                UserFile::FILE_NAME => $fileName,
                UserFile::FILE_TYPE => $type,
                UserFile::ACTIVE => 1,
            ]
        );
    }
}
