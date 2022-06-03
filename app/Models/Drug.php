<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;
    protected $with = ["drugType", "drugForm"];
    protected $fillable = [
        "name", "drug_type_id", "drug_form_id", "brand_id",
        "price", "stock", "image", "description"
    ];

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
        $price = number_format($this->price, 0, ',', '.');
        return "Rp $price";
    }

    public function getFormattedStockAttribute()
    {
        $stock = number_format($this->stock, 0, ',', '.');
        return "$stock";
    }
}
