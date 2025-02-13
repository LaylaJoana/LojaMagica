<?php

namespace Src\Models;

class Cliente extends Model {

    protected $table = 'clientes';

    protected $attributes = [
        'nome',
        'email',
        'telefone',
        'endereco'
    ];
}