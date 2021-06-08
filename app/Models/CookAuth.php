<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookAuth extends Model
{
    use HasFactory;

    protected $table='cookauth';

    protected $fillable = [
        'user_id',
    ];
}
