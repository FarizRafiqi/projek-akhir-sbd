<?php

namespace Database\Seeders;

use App\Models\DrugForm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DrugFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk("local")->get("data/drug_forms.json");
        $drug_forms = json_decode($json);

        foreach ($drug_forms as $value) {
            DrugForm::create([
                "id" => $value->id,
                "form" => $value->form,
            ]);
        }
    }
}
