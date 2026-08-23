<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adds an olfactive "position" (top / heart / base) to each note a
     * product uses. This is additive only — existing rows are backfilled
     * with 'heart' as a safe default so nothing currently in the database
     * is lost or reclassified incorrectly.
     */
    public function up(): void
    {
        Schema::table('fragrance_note_product', function (Blueprint $table) {
            $table->string('position')->default('heart')->after('fragrance_note_id');
        });
    }

    public function down(): void
    {
        Schema::table('fragrance_note_product', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
};
