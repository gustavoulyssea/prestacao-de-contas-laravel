<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rest\UserFiles;

use App\Models\UserFile;
use App\Services\TokenService;
use App\Services\UserFileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Upload extends Controller
{
    /**
     * User file upload
     *
     * Uploads a user file as PDF
     *
     * @group user files
     *
     * @authenticated
     *
     * @bodyParam filename string required Original file name
     * @bodyParam file_type string required file type (contrato_social, cartao_cnpj, etc))
     * @bodyParam pdf file required PDF (max 10MB).
     *
     * @response 201 {
     *   "message": "Arquivo enviado com sucesso",
     *   "filename": "abcd.pdf",
     *   "file_type": "contrato"
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "filename": ["The filename field is required."],
     *     "pdf": ["The pdf must be a file of type: pdf."]
     *   }
     * }
     */
    public function upload(Request $request): JsonResponse
    {
        if (!$userId = TokenService::getUserIdByToken((string) $request->bearerToken())) {
            return TokenService::unauthorizedResult();
        }
        $request->validate([
            'filename' => 'required|string|max:255',
            'file_type' => self::getValidFileTypes(),
            'pdf' => 'required|file|mimes:pdf|max:10240',
        ]);
        $fileType = $request->input('file_type');
        $file = $request->file('pdf');

        $fileName = UserFileService::saveFileAndReturnName($userId, $fileType, $file);

        return response()->json([
            'message' => 'Arquivo enviado com sucesso',
            'filename' => $fileName,
        ], 201);
    }

    public static function getValidFileTypes(): string
    {
        return 'required|string|in:' . implode(',', array_keys(UserFile::VALID_FILE_TYPES));
    }
}
