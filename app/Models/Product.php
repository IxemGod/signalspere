<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // Nom de la table dans la base de données

    protected $fillable = ['id','name', 'price', 'description', 'pictures']; // Colonnes pouvant être remplies en masse

}
