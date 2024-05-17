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
        Schema::create('partes', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado');
            $table->float('parte', precision: 2);
            $table->unsignedBigInteger('us_id');
            $table->unsignedBigInteger('fac_id');
            $table->foreign('fac_id')->references('id')->on('facturas');
            $table->foreign('us_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partes');
    }
};
