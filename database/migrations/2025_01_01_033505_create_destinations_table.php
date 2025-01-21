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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->time('open_at')->default('08:00:00');
            $table->time('close_at')->default('17:00:00');
            $table->string('thumbnail')->nullable();
            $table->string('phone')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
