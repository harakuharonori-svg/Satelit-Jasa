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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_user");
            $table->unsignedBigInteger("id_jasa");
            $table->bigInteger("total");
            $table->enum("status",["Belum","Selesai"]);
            $table->dateTime("deadline");
            $table->dateTime("selesai")->nullable();
            $table->foreign("id_user")->references("id")->on("users");
            $table->foreign("id_jasa")->references("id")->on("jasas");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
