<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('simulation_leads')) {
            Schema::create('simulation_leads', function (Blueprint $table) {
                $table->id();
                $table->string('pic_name', 150);
                $table->string('company_name', 200);
                $table->string('email', 150);
                $table->string('phone', 50);
                $table->string('domain', 80)->default('manufacturing');
                $table->text('notes')->nullable();
                $table->json('simulation_params')->nullable();
                $table->string('status', 40)->default('new'); // new, contacted, closed
                $table->timestamps();

                $table->index('domain');
                $table->index('status');
                $table->index('created_at');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('simulation_leads');
    }
};
