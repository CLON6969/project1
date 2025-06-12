<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_type')->default('MemberRegistrationPayment');
            $table->string('reference')->unique();
            $table->string('narration')->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['mobile', 'card', 'bank']);
            $table->string('mobile_number')->nullable();
            $table->string('card_number')->nullable();
            $table->string('transaction_id')->nullable();
            $table->enum('api_status', ['not_applicable', 'initiated', 'success', 'failed'])->default('not_applicable');
            $table->text('gateway_response')->nullable();
            $table->string('bank_proof')->nullable();
            $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('paid_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'paid', 'rejected'])->default('pending');

            $table->foreignId('pending_subscription_id')->nullable()->constrained('pending_subscriptions')->onDelete('set null');

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('payments');
    }
};

