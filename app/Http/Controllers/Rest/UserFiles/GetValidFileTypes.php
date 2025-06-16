<?php

namespace App\Http\Controllers\Rest\UserFiles;

use App\Http\Controllers\Controller;
use App\Models\UserFile;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetValidFileTypes extends Controller
{
    /**
     * Get Valid User File Types
     *
     * @group user files
     *
     * @authenticated
     *
     * @response scenario=success [
     *
     *      "type_a",
     *      "type_b",
     *      "type_c"
     * ]
     *
     * @response status=401 scenario="Unautorized" {"message": "Unauthorized"}
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function get(Request $request): JsonResponse
    {
        if (!TokenService::getUserIdByToken((string) $request->bearerToken())) {
            return TokenService::unauthorizedResult();
        }
        return response()->json(UserFile::VALID_FILE_TYPES);
    }
}
