<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    // Define the table associated with the model (if it's not the default 'currencies')
    protected $table = 'currencies';

    // Specify the fillable fields to allow mass assignment
    protected $fillable = ['code', 'name', 'symbol'];

    // Optionally, disable timestamps if not needed
    public $timestamps = true; // Set to 'false' if you don't need created_at and updated_at
}
