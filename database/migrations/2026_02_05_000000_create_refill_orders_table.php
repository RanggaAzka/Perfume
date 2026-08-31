<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('refill_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_message_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('refill_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('bottle_size')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            $table->index('refill_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refill_orders');
    }
};
