<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCommande extends Model
{
    protected $fillable = ['id_command', 'id_product', 'quantity'];
}
