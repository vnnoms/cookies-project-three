<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'name',
        'price',
        'stock',
    ];
}