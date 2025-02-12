<?php 

namespace Src\Models;

class Promocao extends Model {

protected $table = 'promocoes';

protected $attributes = [
    'nome',
    'desconto',
    'descricao',
    'data_inicio',
    'data_fim',
];
}