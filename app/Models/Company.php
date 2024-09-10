<?php

// app/Models/Company.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'postal_code',
        'city',
        'siret',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_user');
    }
}