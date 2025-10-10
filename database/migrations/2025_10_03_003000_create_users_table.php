<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $t) {
            $t->id();
            $t->string('firstname');
            $t->string('lastname');
            $t->string('username')->unique(); // de la 2436
            $t->string('role');
            $t->string('email')->unique();
            $t->string('password');
            $t->string('mobile_phone')->nullable(); // de la 2436
            $t->boolean('status')->default(true);
            $t->foreignId('id_city')
                ->nullable()
                ->constrained('cities')
                ->nullOnDelete();
            $t->rememberToken();
            $t->timestamps();
            $t->softDeletes(); // de la 2436
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
