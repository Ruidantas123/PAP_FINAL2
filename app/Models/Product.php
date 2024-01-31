<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product'; // Adjust the table name if needed

    protected $fillable = [
        'name',
        'tipo',
        'quantidade',
        'materiais', // Add this line for the 'materiais' field
        'dimensoes',
    ];
}