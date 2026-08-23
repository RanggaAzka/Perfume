<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fragrance_note_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fragrance_note_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['product_id', 'fragrance_note_id'], 'product_note_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fragrance_note_product');
    }
};
