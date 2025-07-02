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
        'certidao_negativa_federal' => 'Certidão negativa federal',
        'certidao_negativa_municipal' => 'Certidão negativa municipal',
        'certidao_negativa_estadual' => 'Certidão negativa estadual',
        'certidao_negativa_trabalhista' => 'Certidão negativa trabalhista',
        'certidao_fgts' => 'Certidão FGTS',
        'contrato_social' => 'Contrato Social',
        'cartao_cnpj' => 'Cartão CNPJ'
    ];

    public const STORAGE_DIR = 'user_files';

    use HasFactory;
}
