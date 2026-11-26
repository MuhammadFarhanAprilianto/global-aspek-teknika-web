<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'two_factor_secret')) {
                $table->text('two_factor_secret')->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'two_factor_recovery_codes')) {
                $table->text('two_factor_recovery_codes')->nullable()->after('two_factor_secret');
            }
            if (!Schema::hasColumn('users', 'two_factor_confirmed_at')) {
                $table->timestamp('two_factor_confirmed_at')->nullable()->after('two_factor_recovery_codes');
            }
            if (!Schema::hasColumn('users', 'session_version')) {
                $table->unsignedInteger('session_version')->default(1)->after('two_factor_confirmed_at');
            }
            if (!Schema::hasColumn('users', 'idle_timeout_minutes')) {
                $table->unsignedSmallInteger('idle_timeout_minutes')->default(30)->after('session_version');
            }
            if (!Schema::hasColumn('users', 'password_changed_at')) {
                $table->timestamp('password_changed_at')->nullable()->after('idle_timeout_minutes');
            }
        });

        if (!Schema::hasTable('admin_security_logs')) {
            Schema::create('admin_security_logs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('email')->nullable()->index();
                $table->string('event', 60)->index();
                $table->string('status', 20)->default('success');
                $table->string('ip_address', 45)->nullable();
                $table->string('device_label', 120)->nullable();
                $table->string('user_agent', 500)->nullable();
                $table->text('details')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('admin_active_sessions')) {
            Schema::create('admin_active_sessions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('session_id', 191)->unique();
                $table->string('ip_address', 45)->nullable();
                $table->string('device_label', 120)->nullable();
                $table->string('user_agent', 500)->nullable();
                $table->timestamp('last_active_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_active_sessions');
        Schema::dropIfExists('admin_security_logs');

        Schema::table('users', function (Blueprint $table) {
            $cols = [
                'two_factor_secret',
                'two_factor_recovery_codes',
                'two_factor_confirmed_at',
                'session_version',
                'idle_timeout_minutes',
                'password_changed_at',
            ];
            foreach ($cols as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
