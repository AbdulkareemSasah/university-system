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
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Department::class)->index();
            $table->json("name");
            $table->json("slug");
            $table->mediumInteger("count_of_student");
            $table->json("description");
            $table->json("properties");
            $table->json("image");
            $table->json("content");
            $table->boolean("visible");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
