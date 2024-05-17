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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('num_f', length: 20);
            $table->float('monto', precision: 2);
            $table->unsignedBigInteger('pro_id');
            $table->unsignedBigInteger('us_id');
            $table->foreign('pro_id')->references('id')->on('proos');
            $table->foreign('us_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
