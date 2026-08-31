<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_message_id')->nullable()->constrained()->nullOnDelete();
            $table->string('item_type');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('label');
            $table->unsignedInteger('unit_price');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedSmallInteger('bottle_size')->nullable();
            $table->timestamps();

            $table->index(['item_type', 'item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};