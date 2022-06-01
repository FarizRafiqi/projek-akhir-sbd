<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk("local")->get("data/brands.json");
        $brands = json_decode($json);

        foreach ($brands as $value) {
            Brand::create([
                "id" => $value->id,
                "name" => $value->name,
            ]);
        }
    }
}
