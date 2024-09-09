<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pro_name',
        'pro_address',
        'pro_city',
        'pro_siret',
        'client_name',
        'tax_rate',
        'client_address',
        'client_city',
        'client_siret',
        'description',
        'amount',
        'date_devis',
    ];

    /**
     * Get the tasks for the devis.
     */
    public function tasks()
    {
        return $this->hasMany(DevisTask::class);
    }
}