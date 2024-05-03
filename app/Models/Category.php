<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category'; // Nom de la table dans la base de données

    protected $fillable = ['id','name', 'id_products']; // Colonnes pouvant être remplies en masse
    
}
