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
        Schema::create('solution_tables', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); // icon
            $table->string('title1'); // title1
            $table->text('title1_sub_content'); //
            $table->text('content'); // main content
            $table->string('button1_name'); // button1_name
            $table->string('button1_url'); // button1_url

            
            $table->enum('category', ['industrial', 'personal'])->default('industrial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solution_tables');
    }
};
