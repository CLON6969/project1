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
        Schema::create('company_statements', function (Blueprint $table) {
            $table->id();
            $table->string('title1');  // Title1
            $table->text('title1_main_content')->nullable();
            $table->text('title1_sub_content'); // Title1 content
            $table->string('background_picture'); // Background picture
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_statements');
    }
};
