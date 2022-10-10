<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoVendido extends Model
{
    use HasFactory;

    protected $fillable = [
        'venda_id','name','value'
    ];

    public function Venda() {
        return $this->belongsTo(Venda::class);
    }

    public function Produto() {
        return $this->hasMany(Produto::class,'identification_number','produto_id');
    }
}
