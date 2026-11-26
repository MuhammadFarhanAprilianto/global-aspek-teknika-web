<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 50)->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'job_title')) {
                $table->string('job_title', 120)->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('job_title');
            }
            if (!Schema::hasColumn('users', 'identity_verified_at')) {
                $table->timestamp('identity_verified_at')->nullable()->after('avatar');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = array_values(array_filter(
                ['phone', 'job_title', 'avatar', 'identity_verified_at'],
                fn ($c) => Schema::hasColumn('users', $c)
            ));
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
};
