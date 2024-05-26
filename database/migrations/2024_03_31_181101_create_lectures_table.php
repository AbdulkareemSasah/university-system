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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->json("properties")->nullable();
            $table->json("content")->nullable();
            $table->boolean("visible")->default(false);
            $table->boolean("type")->default(false);
            $table->time("start");
            $table->time("end");
            $table->enum("day", [1, 2, 3, 4, 5, 6, 7])->default(1);
            $table->foreignIdFor(\App\Models\Doctor::class)->index();
            $table->foreignIdFor(\App\Models\Subject::class)->index();
            $table->foreignIdFor(\App\Models\Level::class)->index();
            $table->foreignIdFor(\App\Models\Table::class)->index();
            $table->foreignIdFor(\App\Models\ClassRoom::class)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
