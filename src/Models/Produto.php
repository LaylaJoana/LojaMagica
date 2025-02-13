<?php 

namespace Src\Models;

class Produto extends Model {

    protected $table = 'produtos';

    protected $attributes = [
        'nome',
        'preco',
        'estoque'
    ];

    public function updateEstoque($valor)
    {
        $this::update([
            'id' => $this->id,
            'estoque' => (int) $this->estoque + $valor
        ], ['estoque']);
    }
}