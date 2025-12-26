<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Main orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 50)->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('departure_id')->constrained('trip_departures')->cascadeOnDelete();
            $table->foreignId('variant_id')->constrained('departure_variants')->cascadeOnDelete();
            $table->integer('pax_count');
            $table->integer('subtotal'); // Before discount (in IDR)
            $table->integer('discount_amount')->default(0);
            $table->integer('addons_total')->default(0);
            $table->integer('total_amount'); // Final amount (in IDR)
            $table->string('status', 20)->default('pending')->index(); // pending, paid, confirmed, cancelled, refunded
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_proof', 500)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('user_id', 'idx_orders_user');
            $table->index('departure_id', 'idx_orders_departure');
        });

        // Order items (participants)
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('participant_name');
            $table->string('participant_phone', 20)->nullable();
            $table->string('participant_email')->nullable();
            $table->string('participant_id_number', 50)->nullable(); // KTP/Passport
            $table->text('special_requests')->nullable();
            $table->timestamps();
        });

        // Order addons
        Schema::create('order_addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('departure_addon_id')->constrained('departure_addons')->cascadeOnDelete();
            $table->string('addon_name'); // Snapshot name at time of order
            $table->integer('unit_price'); // Snapshot price
            $table->integer('quantity');
            $table->integer('total_price'); // unit_price × quantity
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addons');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
