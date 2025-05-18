<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const UF = 'uf';
    public const CITY = 'city';
    public const STREET = 'street';
    public const STREET_NUMBER = 'street_number';
    public const STREET_COMPLEMENT = 'street_complement';
    public const POST_CODE = 'post_code';

    use HasFactory;
}
