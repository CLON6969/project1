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
        Schema::create('more_table', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); // Background picture
            $table->string('title1'); // Title1
            $table->text('title1_sub_content'); // Title1 content
            $table->string('title2'); // Title1
            $table->text('title2_content'); // Title1 content
            $table->text('title2_sub_content'); // Title1 content

            $table->string('button1_name')->nullable(); // Button2 name (nullable)
            $table->string('button1_url')->nullable(); // 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('more_table');
    }
};
