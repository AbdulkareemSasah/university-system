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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Department::class)->index();
            $table->foreignIdFor(\App\Models\Year::class)->index();
            $table->foreignIdFor(\App\Models\Term::class)->index();
            $table->json("data");
            $table->json("properties");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
