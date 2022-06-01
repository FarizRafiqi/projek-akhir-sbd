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
            ["type" => "Obat Bebas"],
            ["type" => "Obat Resep"],
            ["type" => "Covid Related"]
        ]);
    }
}
