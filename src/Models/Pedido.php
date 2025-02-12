<?php 

namespace Src\Models;

use Src\Core\Database;

class Pedido extends Model {

    protected $table = 'pedidos';

    protected $attributes = [
        'cliente_id',
        'status',
        'valor_total'
    ];

    public function cliente(): bool|Cliente
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
}