<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Campos que podem ser preenchidos no formulário.

class Product extends Model
{
    protected  $fillable = ['name', 'description', 'price', 'image'];
}
