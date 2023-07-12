<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'address',
        'phone',
        'gender',
        'price',
        'clinicid',
        'career',
        'specialize',
        'degree',
        'status',
    ];
}