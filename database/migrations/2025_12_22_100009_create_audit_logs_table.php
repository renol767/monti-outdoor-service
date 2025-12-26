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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action', 50); // create, update, delete, status_change
            $table->string('entity_type', 50); // trip_template, departure, order, etc.
            $table->unsignedBigInteger('entity_id');
            $table->jsonb('old_values')->nullable(); // Before state
            $table->jsonb('new_values')->nullable(); // After state
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['entity_type', 'entity_id'], 'idx_audit_entity');
            $table->index('user_id', 'idx_audit_user');
            $table->index('created_at', 'idx_audit_created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
