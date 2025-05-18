<?php

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ValidateCnpjIsRegistered extends Controller
{
    /**
     * Validate CNPJ is registered
     *
     * Validate if a CNPJ is already registered
     *
     * @group user
     *
     * @responseField result bool CNPJ is registered
     *
     * @param Request $request
     * @param $cnpj
     *
     * @return JsonResponse
     */
    public static function validateCnpjIsRegistered(Request $request, $cnpj): JsonResponse
    {
        $result = (bool) UserRepository::getUserByCnpj($cnpj);
        return response()->json(['result' => $result])->withHeaders(['Content-Type: application/json']);
    }
}
