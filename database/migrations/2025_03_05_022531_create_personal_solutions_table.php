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
        Schema::create('personal_solutions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('background_picture'); // background picture
            $table->string('title1'); // title1
            $table->text('title1_content'); // title1_content
            $table->string('button1_name'); // button1_name
            $table->string('button1_url'); // button1_url
            $table->string('button2_name')->nullable(); // button2_name (nullable)
            $table->string('button2_url')->nullable(); // button2_url (nullable)
            $table->string('title2'); // title2
            $table->string('picture1'); // picture1
            $table->string('title3'); // title3
            $table->text('title3_content'); // title3_content
            $table->string('button3_name'); // button3_name
            $table->string('button3_url'); // button3_url
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_solutions');
    }
};
