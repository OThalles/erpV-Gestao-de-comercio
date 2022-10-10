<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'identification_number',
        'name',
        'price',
        'quantity'
    ];

    protected $primaryKey = 'identification_number';

    public function user() {
        return $this->belongsTo(User::class);
    }

}
