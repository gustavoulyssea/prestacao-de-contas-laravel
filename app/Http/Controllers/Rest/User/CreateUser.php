<?php

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateUser extends Controller
{
    /**
     * Create user
     *
     * @bodyParam name string required
     * @bodyParam email string required
     * @bodyParam password string required
     * @bodyParam password_confirmation string required
     * @bodyParam cnpj string required
     * @bodyparam razao_social string required
     * @bodyparam responsible_name string required
     * @bodyparam telephone string required
     *
     * @response scenario=success {
     *    "bearer_token": "tokenabcde",
     *    "validuntil": "1747515969",
     *   }
     *
     * @response status=422 scenario="Invalid data" {"message": "Invalid data"}
     *
     * @response status=422 scenario="Invalid CNPJ or password" {"message": "Invalid CNPJ or password"}
     *
     * @group user
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
            'cnpj' => $request->input('cnpj'),
            'razao_social' => $request->input('razao_social'),
            'responsible_name' => $request->input('responsible_name'),
            'telephone' => $request->input('telephone'),
        ];

        if ($validateInputResult = self::validateInput($userData)) {
            return $validateInputResult;
        }

        unset($userData['password_confirmation']);

        $createResult = UserService::create($userData);

        if (is_array($createResult)) {
            return response()->json(
                $createResult,
                401
            );
        }

        $token = TokenService::generateUserToken($userData['cnpj'], $userData['password']);

        return response()->json(
            [
                'bearer_token' => $token,
                'valid_until' => time() + 86400
            ]
        );
    }

    /**
     * @param array $userData
     *
     * @return JsonResponse|null
     */
    public static function validateInput(array $userData): ?JsonResponse
    {
        if ($field = self::checkEmptyUserData($userData)) {
            return response()->json(['message' => $field . ' is empty.'], 422);
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            return response()->json(['message' => $field . ' is invalid.'], 422);
        }

        if ($userData['password'] !== $userData['password_confirmation']) {
            return response()->json(['message' => 'Passwords do not match.'], 422);
        }
        return null;
    }

    /**
     * @param array $userData
     *
     * @return string|null
     */
    public static function checkEmptyUserData(array $userData): ?string
    {
        foreach ($userData as $key => $value) {
            if (empty($value)) {
                return $key;
            }
        }
        return null;
    }
}
