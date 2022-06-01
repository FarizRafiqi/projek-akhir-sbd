<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $with = ["drugType", "drugForm"];
    
    public function drugType()
    {
        return $this->belongsTo(DrugType::class);
    }

    public function drugForm()
    {
        return $this->belongsTo(DrugForm::class);
    }

    public function getFormattedPriceAttribute()
    {
        $price = number_format($this->price, 2, ',', '.');
        return "Rp $price";
    }
}
