<?php 

namespace Src\Models;

class Produto extends Model {

    protected $table = 'produtos';

    protected $attributes = [
        'nome',
        'preco',
        'estoque'
    ];
}