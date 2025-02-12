<?php 

namespace Src\Models;

class ItemPedido extends Model {

    protected $table = 'itens_pedido';

    protected $attributes = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco_unitario'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }
}