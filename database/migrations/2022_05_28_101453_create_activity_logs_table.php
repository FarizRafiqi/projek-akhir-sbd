<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); //User mana yang melakukan suatu event
            $table->string('reference_table'); //Tabel mana yang sedang di track aktivitasnya
            $table->unsignedBigInteger('reference_id')->nullable(); //Record (baris) mana dari tabel yang di referensikan
            $table->text('description'); // Apa yang dilakukan oleh mereka
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
        Schema::dropIfExists('activity_logs');
    }
}
