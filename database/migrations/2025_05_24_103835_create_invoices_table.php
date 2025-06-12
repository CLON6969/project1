<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('number')->unique();
            $table->string('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['unpaid', 'paid', 'overdue'])->default('unpaid');
            $table->boolean('is_paid')->default(false);
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('solution_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services_table')->onDelete('set null');
            $table->foreign('solution_id')->references('id')->on('solution_tables')->onDelete('set null');
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('invoices');
    }
};