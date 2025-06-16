<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rest\UserFiles;

use App\Services\TokenService;
use App\Services\UserFileService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class Download extends Controller
{
    /**
     * Download a user file by type
     *
     * @authenticated
     *
     * @group user files
     *
     * @urlParam file_type string required (ex: contrato, nota_fiscal, recibo)
     *
     * @response 200 {
     * "application/pdf": "(binary file content)"
     * }
     *
     * @response 404 {
     *   "message": "Arquivo não encontrado."
     * }
     */
    public function download(Request $request, string $file_type): Response
    {
        if (!$userId = TokenService::getUserIdByToken((string) $request->bearerToken())) {
            return TokenService::unauthorizedResult();
        }

        return UserFileService::download($userId, $file_type);
    }
}
