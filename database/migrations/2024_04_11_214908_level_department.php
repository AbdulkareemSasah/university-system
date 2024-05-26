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
        Schema::create('level_departments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Department::class)->index();
            $table->foreignIdFor(\App\Models\Level::class)->index();
            $table->mediumInteger("count_of_student");
            $table->unique(["department_id", "level_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_departments');
    }
};