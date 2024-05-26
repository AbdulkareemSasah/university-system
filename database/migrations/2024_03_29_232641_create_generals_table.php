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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->json("university_name");
            $table->json("description");
            $table->json("schooling_days");
            $table->json("navbar")->nullable();
            $table->json("footer")->nullable();
            $table->json("table")->nullable();
            $table->string("image")->nullable();
            $table->string("logo")->nullable();
            $table->string("dark_logo")->nullable();
            $table->string("light_logo")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generals');
    }
};
