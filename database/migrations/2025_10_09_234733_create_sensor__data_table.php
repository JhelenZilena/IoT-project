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
        Schema::create('sensor__data', function (Blueprint $t) {
              $t->id();
              $t->foreignId('id_sensor')->constrained('sensors');
              $t->foreignId('id_station')->constrained('stations');
              $t->float('temp_value')->nullable();
              $t->boolean('status')->default(true);
              $t->timestamps();
              $t->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor__data');
    }
};
