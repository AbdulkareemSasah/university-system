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
        Schema::create('department_lecture', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Department::class)->index();
            $table->foreignIdFor(\App\Models\Lecture::class)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_lecture');
    }
};
