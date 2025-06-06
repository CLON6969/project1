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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->enum('user_type', ['individual', 'company', 'institution'])->default('individual');
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->enum('account_status', ['active', 'suspended', 'pending'])->default('pending');

            // Contact Info
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('website')->nullable();

            // Organizational Details
            $table->string('organization_type')->nullable();
            $table->string('industry')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('organization_size')->nullable();

            // Verification and Security
            $table->boolean('two_factor_enabled')->default(false);
            $table->boolean('email_verified')->default(false);
            $table->string('id_document_path')->nullable();
            $table->string('business_license_path')->nullable();

            // Optional fields
            $table->text('bio')->nullable();
            $table->string('referral_source')->nullable();

            // Relationships
            $table->foreignId('parent_account_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('account_type', ['main', 'sub'])->default('main');

            // Laravel auth defaults
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            // Role
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');

            // form completion
            $table->boolean('profile_completed')->default(false);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['parent_account_id']);
        });

        Schema::dropIfExists('users');
    }
};
