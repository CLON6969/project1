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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // logged-in user
        $table->string('transaction_type')->default('MemberRegistrationPayment');
        $table->string('reference')->unique(); // like #1SDYMJUKVM
        $table->string('narration')->nullable(); // user name or comment
        $table->decimal('amount', 10, 2);
        $table->enum('payment_method', ['mobile', 'card', 'bank']);
        $table->string('mobile_number')->nullable();
        $table->string('card_number')->nullable();
        $table->string('transaction_id')->nullable(); // for future API use
        $table->enum('api_status', ['not_applicable', 'initiated', 'success', 'failed'])->default('not_applicable');
        $table->text('gateway_response')->nullable(); // store JSON/raw response
        $table->string('bank_proof')->nullable(); // path to uploaded file
        $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('set null');
        $table->timestamp('paid_at')->nullable();      // Record actual payment date/time
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->text('notes')->nullable(); // Optional for admin/staff
        $table->timestamps();
    });
}

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};


