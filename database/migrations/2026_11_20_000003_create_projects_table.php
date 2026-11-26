<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('title', 255);
                $table->string('slug', 255)->unique();
                $table->string('client_name', 200)->nullable();
                $table->string('category', 100)->default('Automation');
                $table->string('year', 10)->nullable()->default('2024');
                $table->text('description')->nullable();
                $table->string('image', 500)->nullable();
                $table->boolean('is_featured')->default(true);
                $table->integer('sort_order')->default(0);
                $table->timestamps();

                $table->index('category');
                $table->index('is_featured');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
