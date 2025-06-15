<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserFile;
use App\Repositories\UserFileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class UserFileService
{
    /**
     * @param int $userId
     * @param string $fileType
     *
     * @return Response
     */
    public static function download(int $userId, string $fileType): Response
    {
        if (!$fileName = UserFileRepository::getFileNameByUserIdAndType($userId, $fileType)) {
            return response()->json(['message' => 'Arquivo não encontrado.'], 404);
        }

        if (!Storage::exists(UserFile::STORAGE_DIR . '/' . $fileName)) {
            return response()->json(['message' => 'Arquivo não existe no armazenamento.'], 404);
        }

        return Storage::download(UserFile::STORAGE_DIR  . '/' . $fileName, $fileName, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * @param int $userId
     * @param string $fileType
     * @param UploadedFile $file
     *
     * @return string
     */
    public static function saveFileAndReturnName(int $userId, string $fileType, UploadedFile $file): string
    {
        $storageFilename = self::getValidStorageFileName();
        $file->storeAs(UserFile::STORAGE_DIR, $storageFilename);
        UserFileRepository::invalidateFilesByCustomerAndType($userId, $fileType);
        UserFileRepository::createFile($userId, $fileType, $storageFilename);
        return $storageFilename;
    }

    /**
     * @return string
     */
    private static function getValidStorageFileName(): string
    {
        do {
            $uuid = (string) Str::uuid();
        } while (UserFileRepository::getFileByName($uuid . '.pdf'));
        return $uuid . '.pdf';
    }
}
