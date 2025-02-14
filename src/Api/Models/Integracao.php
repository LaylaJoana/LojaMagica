<?php

namespace Src\Api\Models;

use Src\Models\Model;

class Integracao extends Model {

    protected $table = 'importacoes';

    protected $attributes = [
        'xml',
        'criado_em'
    ];
}