<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisTask extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'devis_id',
        'item_description',
        'item_price',
        'item_quantity',
    ];

    /**
     * Get the devis that owns the task.
     */
    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
}