<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rest\UserFiles;

use App\Services\TokenService;
use App\Services\UserFileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Delete extends Controller
{
    /**
     * Delete user file
     *
     * @group user files
     *
     * @authenticated
     *
     * @urlParam file_type string required file type (contrato_social, cartao_cnpj, etc))
     *
     * @response 201 {
     *   "success": true,
     *   "message": "File successfully deleted",
     * }
     *
     */
    public function delete(Request $request, string $file_type): JsonResponse
    {
        if (!$userId = TokenService::getUserIdByToken((string) $request->bearerToken())) {
            return TokenService::unauthorizedResult();
        }
        $result = UserFileService::delete($userId, $file_type);
        return response()->json([
            'success' => $result,
            'message' => $result ? 'File successfully deleted' : 'File not found',
        ]);
    }
}
