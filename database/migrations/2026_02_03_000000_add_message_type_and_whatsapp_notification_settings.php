<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('type')->default('contact')->index()->after('email');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('fonnte_token')->nullable()->after('store_hours');
            $table->string('whatsapp_target')->nullable()->after('fonnte_token');
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['fonnte_token', 'whatsapp_target']);
        });
    }
};
