<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_histories', function (Blueprint $table) {
            $table->string('id', 15)->index();

            $table->string('first_code', 8)->nullable();
            $table->string('last_code', 8)->nullable();

            $table->double('close',25,10)->nullable();
            $table->double('open',25,10)->nullable();
            $table->double('high',25,10)->nullable();
            $table->double('low',25,10)->nullable();
            $table->double('volume',25,10)->nullable();
            $table->double('quoteVolume',25,10)->nullable();
            $table->unsignedBigInteger('eventTime')->nullable();

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
        Schema::dropIfExists('symbol_histories');
    }
};
