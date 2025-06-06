<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public const ID = 'id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';
    public const CNPJ = 'cnpj';
    public const RAZAO_SOCIAL = 'razao_social';
    public const RESPONSIBLE_NAME = 'responsible_name';
    public const TELEPHONE = 'telephone';
    public const RESET_PASSWORD_TOKEN = 'reset_password_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'cnpj',
        'razao_social',
        'responsible_name',
        'telephone',
        'uf',
        'city',
        'street',
        'street_number',
        'street_complement',
        'post_code',
    ];
}
