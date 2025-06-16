<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rest\UserFiles;

use App\Services\TokenService;
use App\Services\UserFileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListFiles extends Controller
{
    /**
     * List user files
     *
     * @group user/file
     *
     * @authenticated
     *
     * @response 201 {
     *   "type_1": "abcd",
     *   "type_2": "xxzz",
     * }
     *
     */
    public function list(Request $request): JsonResponse
    {
        if (!$userId = TokenService::getUserIdByToken((string) $request->bearerToken())) {
            return TokenService::unauthorizedResult();
        }
        $result = UserFileService::getUserFileList($userId);
        return response()->json([
            $result
        ]);
    }
}
