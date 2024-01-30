<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $table = 'carts'; // Specifica il nome della tabella

    protected $fillable = ['user_id', 'product_id', 'quantity'];


}
