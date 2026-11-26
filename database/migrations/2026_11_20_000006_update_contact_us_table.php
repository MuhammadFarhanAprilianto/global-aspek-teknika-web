<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            if (!Schema::hasColumn('contact_us', 'name')) {
                $table->string('name', 150)->nullable()->after('id');
            }
            if (!Schema::hasColumn('contact_us', 'email')) {
                $table->string('email', 150)->nullable()->after('name');
            }
            if (!Schema::hasColumn('contact_us', 'phone')) {
                $table->string('phone', 50)->nullable()->after('email');
            }
            if (!Schema::hasColumn('contact_us', 'company')) {
                $table->string('company', 200)->nullable()->after('phone');
            }
            if (!Schema::hasColumn('contact_us', 'service')) {
                $table->string('service', 150)->nullable()->after('company');
            }
            if (!Schema::hasColumn('contact_us', 'message')) {
                $table->text('message')->nullable()->after('service');
            }
            if (!Schema::hasColumn('contact_us', 'status')) {
                $table->string('status', 40)->default('unread')->after('message'); // unread, read, contacted
            }
        });
    }

    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'company', 'service', 'message', 'status']);
        });
    }
};
