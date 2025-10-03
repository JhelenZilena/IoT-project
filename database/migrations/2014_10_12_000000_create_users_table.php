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
        Schema::create('users', function (Blueprint $t) {
            $t->id();
            $t->sting('firstname');
            $t->sting('lastname');
            $t->sting('username');
            $t->sting('role');
            $t->sting('email')->unique();
            $t->sting('password');
            $t->sting('mobile_phone');
            $t->boolean('status')->default(true);
            $t->unsignedBigInteger('id_city')->nullable();
            $t->rememberToken();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
