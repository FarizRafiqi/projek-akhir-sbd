<?php

namespace Database\Seeders;

use App\Models\DrugType;
use Illuminate\Database\Seeder;

class DrugTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DrugType::insert([
            [
                "type" => "Obat Bebas",
                "image" => "fas fa-pills",
                "slug" => "obat-bebas",
            ],
            [
                "type" => "Obat Resep",
                "image" => "fas fa-receipt",
                "slug" => "obat-resep",
            ],
            [
                "type" => "Covid Related",
                "image" => "fas fa-virus",
                "slug" => "covid-related",
            ]
        ]);
    }
}
