<?php 

namespace Src\Models;

class Pedido extends Model {

    protected $table = 'pedidos';

    protected $attributes = [
        'cliente_id',
        'status'
    ];

    public function cliente(): bool|Cliente
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
}