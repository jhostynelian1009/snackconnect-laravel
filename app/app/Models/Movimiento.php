<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Movimiento extends Model
{
    // Table reserved for future Inventory module integration
    protected $table = 'movimientos';

    // Guarded to avoid mass-assignment assumptions
    protected $guarded = [];

    // Relations (defined as strings where related models may not yet exist)
    public function product()
    {
        return $this->belongsTo('App\\Models\\Product', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\\Models\\Provider', 'provider_id');
    }
}
