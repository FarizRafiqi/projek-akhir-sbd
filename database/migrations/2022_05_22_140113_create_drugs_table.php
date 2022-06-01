<?php

use App\Models\DrugForm;
use App\Models\DrugType;
use App\Models\Brand;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DrugType::class)->constrained();
            $table->foreignIdFor(DrugForm::class)->constrained();
            $table->foreignIdFor(Brand::class)->constrained();
            $table->string("name");
            $table->string("image")->nullable();
            $table->decimal("price", 10, 2);
            $table->text("description");
            $table->integer("stock");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drugs');
    }
}
