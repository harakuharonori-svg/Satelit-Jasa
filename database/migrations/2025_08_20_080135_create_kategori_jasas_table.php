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
        Schema::create('kategori_jasas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_jasa");
            $table->unsignedBigInteger("id_kategori");
            $table->foreign("id_jasa")->references("id")->on("jasas");
            $table->foreign("id_kategori")->references("id")->on("kategoris");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_jasas');
    }
};
