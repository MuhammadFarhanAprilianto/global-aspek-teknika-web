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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('invoice_number')->unique();
            $table->string('verification_hash', 64);

            // Identitas Pemesan Korporat (B2B)
            $table->string('pic_name');
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_phone', 35);
            $table->string('npwp', 40)->nullable();
            $table->text('notes')->nullable();

            // Kalkulasi Harga Murni Server-Side
            $table->decimal('subtotal', 16, 2)->default(0);
            $table->decimal('tax_rate', 5, 2)->default(11.00);
            $table->decimal('tax_amount', 16, 2)->default(0);
            $table->decimal('grand_total', 16, 2)->default(0);

            // Metode Penyelesaian B2B & Dokumen PO
            $table->string('payment_method', 40)->default('b2b_po');
            $table->string('po_number', 100)->nullable();
            $table->string('po_document_path')->nullable();
            $table->string('status', 30)->default('awaiting_po')->index();

            // Audit Keamanan Siber
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('po_submitted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete();
            $table->string('sku', 60);
            $table->string('product_name');
            $table->decimal('unit_price', 16, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('line_total', 16, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};

