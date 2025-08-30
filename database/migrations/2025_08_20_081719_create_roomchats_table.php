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
        Schema::create('roomchats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_user1");
            $table->unsignedBigInteger("id_user2");
            $table->foreign("id_user1")->references("id")->on("users");
            $table->foreign("id_user2")->references("id")->on("users");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roomchats');
    }
};
