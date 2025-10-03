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
        Schema::create('sensors', function (Blueprint $table) {
             $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('abbrev')->unique();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('id_department');
            $table->timestamps();
            $table->softDeletes();
            // Foreign key
            //$table->foreign('id_department')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensors');
    }
};
