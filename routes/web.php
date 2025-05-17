<?php

use App\Http\Controllers\Rest\User\ValidateCnpjIsRegistered;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->noContent(); // status 204 - sem conteúdo
});

Route::name('rest.')->prefix('/rest')->group(function () {
    Route::get(
        '/validate-cnpj-is-registered/{CNPJ}',
        [ValidateCnpjIsRegistered::class, 'validateCnpjIsRegistered']
    );
});
