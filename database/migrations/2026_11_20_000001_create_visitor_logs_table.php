<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('visitor_logs')) {
            Schema::create('visitor_logs', function (Blueprint $table) {
                $table->id();
                $table->string('ip_address', 45)->nullable();
                $table->string('page_url', 500);
                $table->string('route_name', 100)->nullable();
                $table->string('user_agent', 500)->nullable();
                $table->string('device', 50)->nullable()->default('Desktop');
                $table->string('browser', 50)->nullable();
                $table->string('platform', 50)->nullable();
                $table->string('referer', 500)->nullable();
                $table->timestamps();

                $table->index('created_at');
                $table->index('page_url');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
