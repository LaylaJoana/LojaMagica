<?php

namespace Src\Models;

class Cliente extends Model {

    protected $table = 'clientes';

    protected $attributes = [
        'tipo',
        'nome',
        'email',
        'telefone',
        'endereco',
        'receber_emails'
    ];
}