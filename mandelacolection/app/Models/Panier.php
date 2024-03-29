<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'commande_id',
        'lieu_commande',
        'active'
    ];
}
