<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_id', 'drug_id', 'quantity'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
