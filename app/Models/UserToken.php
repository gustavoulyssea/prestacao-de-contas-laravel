<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const TOKEN_HASH = 'token_hash';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    use HasFactory;
}
