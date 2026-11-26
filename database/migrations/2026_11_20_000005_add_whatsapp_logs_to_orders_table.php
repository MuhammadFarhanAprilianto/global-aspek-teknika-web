<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'whatsapp_contacted_at')) {
                $table->timestamp('whatsapp_contacted_at')->nullable()->after('po_submitted_at');
            }
            if (!Schema::hasColumn('orders', 'whatsapp_message_log')) {
                $table->text('whatsapp_message_log')->nullable()->after('whatsapp_contacted_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_contacted_at', 'whatsapp_message_log']);
        });
    }
};
