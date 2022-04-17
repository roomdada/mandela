<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commande extends Model
{
    use HasFactory;
    protected $filllable = [
        'article_id',
        'qunatite',
        'prix_total',
        'date_commande',
        'active'
    ];
}
