<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 
        'total',
        'status',
        'order_date',
        // otros campos
    ];

    // Relación con cliente
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
    
}