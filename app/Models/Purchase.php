<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'total_price', 'paid',
        'change', 'buy_date', 'status'
    ];

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedTotalPriceAttribute()
    {
        $totalPrice = number_format($this->total_price, 0, ',', '.');
        return "Rp $totalPrice";
    }

    public function getFormattedPaidAttribute()
    {
        $paid = number_format($this->paid, 0, ',', '.');
        return "Rp $paid";
    }

    public function getFormattedChangeAttribute()
    {
        $change = number_format($this->change, 0, ',', '.');
        return "Rp $change";
    }
}
