<?php

namespace Database\Seeders;

use App\Models\Drug;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk("local")->get("data/drugs.json");
        $drugs = json_decode($json);

        foreach ($drugs as $value) {
            Drug::create([
                "drug_type_id" => $value->drug_type_id,
                "drug_form_id" => $value->drug_form_id,
                "brand_id" => $value->brand_id,
                "name" => $value->name,
                "image" => $value->image,
                "price" => $value->price,
                "description" => $value->description,
                "stock" => rand(100, 1000),
                "slug" => Str::of($value->name)->slug()
            ]);
        }
    }
}
