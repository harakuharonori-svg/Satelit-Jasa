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
        Schema::create('jasa_banners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_jasa");
            $table->string("image"); // Path untuk menyimpan file banner
            $table->foreign("id_jasa")->references("id")->on("jasas");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jasa_banners');
    }
};
