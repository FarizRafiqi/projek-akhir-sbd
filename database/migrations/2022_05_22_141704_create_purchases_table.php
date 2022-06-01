<?php

use App\Models\Drug;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Drug::class)->constrained();
            $table->unsignedInteger("quantity");
            $table->decimal("total_price", 10, 2);
            $table->decimal("paid", 10, 2);
            $table->decimal("change", 10, 2);
            $table->timestamp("buy_date");
            $table->enum("status", ["success", "pending", "failed"]);
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
        Schema::dropIfExists('purchases');
    }
}
