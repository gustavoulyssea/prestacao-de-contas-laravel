<?php

use App\Http\Controllers\Rest\User\CreateUser;
use App\Http\Controllers\Rest\User\GenerateToken;
use App\Http\Controllers\Rest\User\GetUser;
use App\Http\Controllers\Rest\User\RequestResetPasswordLink;
use App\Http\Controllers\Rest\User\ResetPasswordController;
use App\Http\Controllers\Rest\User\ValidateCnpjIsRegistered;
use App\Http\Controllers\Rest\UserFiles\Download;
use App\Http\Controllers\Rest\UserFiles\GetValidFileTypes;
use App\Http\Controllers\Rest\UserFiles\Upload;
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

Route::name('rest.v1.')->prefix('/rest/V1')->group(function () {
    Route::name('user.')->prefix('/user')->group(function () {
        Route::get(
            '/me',
            [GetUser::class, 'get']
        );
        Route::post(
            '/create-user',
            [CreateUser::class, 'create']
        );
        Route::get(
            '/validate-cnpj-is-registered/{CNPJ}',
            [ValidateCnpjIsRegistered::class, 'validateCnpjIsRegistered']
        );
        Route::post(
            '/generate-token',
            [GenerateToken::class, 'generateToken']
        );
        Route::post(
            '/request-reset-password-link',
            [RequestResetPasswordLink::class, 'post']
        );
        Route::post(
            '/reset-password',
            [ResetPasswordController::class, 'post']
        );
        Route::name('file.')->prefix('/file')->group(function () {
            Route::get(
                '/valid-types',
                [GetValidFileTypes::class, 'get']
            );
            Route::post(
                '/upload',
                [Upload::class, 'upload']
            );
            Route::get(
                '/download/{file_type}',
                [Download::class, 'download']
            );
        });
    });
});
