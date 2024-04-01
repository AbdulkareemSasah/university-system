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
        Schema::create('subject_level_doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Level::class)->index();
            $table->foreignIdFor(\App\Models\Subject::class)->index();
            $table->foreignIdFor(\App\Models\User::class)->index();
            $table->json("properties");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_level_doctors');
    }
};
