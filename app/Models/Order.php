<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'outlet_id',
        'total_amount',
        'status',
        'transferred_to',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function transferredTo()
    {
        return $this->belongsTo(Outlet::class, 'transferred_to');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
