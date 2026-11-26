<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('simulation_leads', function (Blueprint $table) {
            if (!Schema::hasColumn('simulation_leads', 'job_title')) {
                $table->string('job_title', 120)->nullable()->after('company_name');
            }
            if (!Schema::hasColumn('simulation_leads', 'simulation_date')) {
                $table->date('simulation_date')->nullable()->after('domain');
            }
        });
    }

    public function down(): void
    {
        Schema::table('simulation_leads', function (Blueprint $table) {
            if (Schema::hasColumn('simulation_leads', 'simulation_date')) {
                $table->dropColumn('simulation_date');
            }
            if (Schema::hasColumn('simulation_leads', 'job_title')) {
                $table->dropColumn('job_title');
            }
        });
    }
};
