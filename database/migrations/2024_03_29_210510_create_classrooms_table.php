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
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->json("name");
            $table->json("slug")->nullable();
            $table->mediumInteger("capacity");
            $table->json("properties")->nullable();
            $table->json("description")->nullable();
            $table->string("image")->nullable();
            $table->json("content")->nullable();
            $table->enum("type", ["practical", "theoretical"])->default("theoretical");
            $table->boolean("visible")->default(false);
            $table->boolean("has_projector")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
