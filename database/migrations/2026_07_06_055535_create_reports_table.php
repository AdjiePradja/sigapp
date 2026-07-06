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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique();
            $table->string('type'); // hazard | emg
            $table->string('category');
            $table->string('location');
            $table->text('description');
            $table->string('status')->default('open'); // open | prog | done
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('gps_lat', 10, 6)->nullable();
            $table->decimal('gps_lng', 10, 6)->nullable();
            $table->unsignedInteger('gps_acc')->nullable();
            $table->boolean('gps_manual')->default(false);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
