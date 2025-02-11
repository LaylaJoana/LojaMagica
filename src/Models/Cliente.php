<?php

namespace Src\Models;

class Cliente extends Model {

    protected $table = 'clientes';

    protected $attributes = [
        'id',
        'nome',
        'email',
        'telefone',
        'endereco',
        'criado_em'
    ];

}