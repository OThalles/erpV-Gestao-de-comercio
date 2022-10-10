<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $fillable = [
        'made_by','amount','quantity_products'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'made_by', 'id');
    }

    public function cliente() {
        return $this->HasOne(Cliente::class);
    }
}
