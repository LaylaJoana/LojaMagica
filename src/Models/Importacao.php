<?php

namespace Src\Models;

class Importacao extends Model {

    protected $table = 'importacoes';

    protected $attributes = [
        'tipo',
        'arquivo'
    ];
}