<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class componente extends model
{
    use HasFactory;

    protected $table = 'components';

    protected $fillable = [
        'name',
        'tipo',
        'quantidade',
        'dimensoes',
    ];
}