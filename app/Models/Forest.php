<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'userid',
    'surname',
    'lastname',
    'phone',
    'price',
    'email',
    'area',
    'typeid',
    'ageid',
    'idnum'
    ];
}
