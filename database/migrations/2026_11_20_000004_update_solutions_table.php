<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solutions', function (Blueprint $table) {
            if (!Schema::hasColumn('solutions', 'slug')) {
                $table->string('slug', 255)->nullable()->after('name');
            }
            if (!Schema::hasColumn('solutions', 'short_description')) {
                $table->string('short_description', 500)->nullable()->after('description');
            }
            if (!Schema::hasColumn('solutions', 'icon_svg')) {
                $table->text('icon_svg')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('solutions', 'show_in_navbar')) {
                $table->boolean('show_in_navbar')->default(true)->after('icon_svg');
            }
            if (!Schema::hasColumn('solutions', 'route_name')) {
                $table->string('route_name', 100)->nullable()->after('show_in_navbar');
            }
            if (!Schema::hasColumn('solutions', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('route_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->dropColumn(['slug', 'short_description', 'icon_svg', 'show_in_navbar', 'route_name', 'sort_order']);
        });
    }
};
