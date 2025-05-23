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
        Schema::create('events_table', function (Blueprint $table) {
            $table->id();
            $table->string('picture'); // Background picture
            $table->string('title1'); // Title1
            $table->text('title1_content'); // Title1 content
            $table->string('country'); // Country
            $table->string('town'); // Town
            $table->string('main_tittle')->nullable(); // Main title (nullable)
            $table->text('main_tittle_content')->nullable(); // Main title content (nullable)
            $table->enum('day', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']); // Day
            $table->date('date'); // Date
            $table->time('start_time'); // Start time
            $table->time('end_time'); // End time
            $table->string('button1_name')->nullable();
            $table->string('button1_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_table');
    }
};
