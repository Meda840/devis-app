<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Define the table name if it's not following the default Laravel naming convention
    protected $table = 'services';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'name',
        'description',
        'unit_price',
    ];
}