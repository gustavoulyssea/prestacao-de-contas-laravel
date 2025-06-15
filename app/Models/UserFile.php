<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const FILE_TYPE = 'file_type';
    public const FILE_NAME = 'file_name';
    public const ACTIVE = 'active';

    public const VALID_FILE_TYPES = [
        'certidao_negativa_federal',
        'certidao_negativa_municipal',
        'certidao_negativa_estadual',
        'certidao_negativa_trabalhista',
        'certidao_fgts',
        'contrato_social',
        'cartao_cnpj'
    ];

    public const STORAGE_DIR = 'user_files';

    use HasFactory;
}
