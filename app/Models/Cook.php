<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cook extends Model
{
    use HasFactory;

    protected $table = 'cook';
    
    protected $fillable = [
        'title',
        'materials',
        'nutritions',
        'cat_ids',
        'cook_time',
        'num_people',
        'created_by',
        'picture_name',
        'picture_path',
        'howtomake',
        'point',
        'excerpt'
    ];
    
}
