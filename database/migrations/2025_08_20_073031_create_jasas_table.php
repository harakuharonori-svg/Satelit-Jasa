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
        Schema::create('jasas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_store");
            $table->string("judul"); // Judul jasa
            $table->text("deskripsi"); // Deskripsi jasa
            $table->bigInteger("harga"); // Harga jasa
            $table->foreign("id_store")->references("id")->on("stores");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jasas');
    }
};
