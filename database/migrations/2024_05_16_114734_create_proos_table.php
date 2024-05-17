<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_p', length: 50);
            $table->string('dir_p', length: 50);
            $table->string('tel_p', length: 20);
            $table->string('cuit_p', length: 13);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proos');
    }
};
