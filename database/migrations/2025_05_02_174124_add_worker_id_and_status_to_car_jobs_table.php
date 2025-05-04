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
        Schema::table('car_jobs', function (Blueprint $table) {
            $table->foreignId('worker_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['unassigned', 'assigned', 'in_progress', 'completed'])->default('unassigned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_jobs', function (Blueprint $table) {
            $table->dropForeign(['worker_id']);
            $table->dropColumn(['worker_id', 'status']);
        });
    }
};
