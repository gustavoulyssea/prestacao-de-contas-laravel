<?php

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerateToken extends Controller
{
    public const INPUT_CNPJ = 'cnpj';
    public const INPUT_PASSWORD = 'password';
    public function generateToken(Request $request)
    {
        $cnpj = $request->input(self::INPUT_CNPJ);
        $password = $request->input(self::INPUT_PASSWORD);

    }
}
