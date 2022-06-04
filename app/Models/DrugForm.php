<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugForm extends Model
{
    use HasFactory;
    protected $fillable = ['form'];

    public function drugs()
    {
        return $this->hasMany(Drug::class);
    }
}
