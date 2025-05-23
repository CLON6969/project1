<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('homepage_contents', function (Blueprint $table) {
            $table->id();
            $table->string('background_picture'); // To store the background picture
            $table->string('title1');
            $table->text('title1_content');
            $table->string('title2');
            $table->text('title2_content');
            $table->string('picture1'); // For the image
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_contents');
    }
};
