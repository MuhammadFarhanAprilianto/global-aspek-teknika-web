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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('product_categories')->cascadeOnDelete();
            $table->string('sku', 64)->unique();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->string('badge_primary', 100)->nullable();
            $table->string('badge_secondary', 100)->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->unsignedInteger('stock')->default(10);
            $table->unsignedInteger('min_order_quantity')->default(1);
            $table->boolean('is_rfq_only')->default(false);
            $table->boolean('is_featured')->default(true);
            $table->enum('status', ['draft', 'published', 'archived'])->default('published');
            $table->string('image', 255)->nullable();
            $table->json('specifications')->nullable();
            $table->string('datasheet_url', 255)->nullable();
            $table->timestamps();

            $table->index(['category_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
