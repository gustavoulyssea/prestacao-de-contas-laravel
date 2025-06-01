<?php

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Models\Mail\ResetPasswordEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RequestResetPasswordLink extends Controller
{
    /**
     *  Request reset password link
     *
     * @group user
     *
     * @bodyParam email string required email
     *
     * @response scenario=success {
     *    "msg": "Um email contendo link para reset da senha foi enviado caso o email esteja cadastrado.",
     *   }
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function post(Request $request): JsonResponse
    {
        if (!$request->json()->has('email')) {
            // Bora enrolar o espertinho
            sleep(3);
        } elseif ($email = $request->json()->get('email')) {
            ResetPasswordEmail::send($email);
        } else {
            // Bora enrolar o espertinho
            sleep (3);
        }
        return response()->json(
            [
                'msg' => 'Um email contendo link para reset da senha foi enviado caso o email esteja cadastrado.'
            ]
        );
    }
}
