<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_tittle'); // Package name (Educenter, Woods)
            $table->text('statement')->nullable();
            $table->string('tittle1')->nullable();
            $table->text('tittle1_content')->nullable();
            $table->string('tittle2')->nullable();
            $table->text('tittle2_content')->nullable();
            $table->string('tittle3')->nullable();
            $table->text('tittle3_content')->nullable();
            $table->string('tittle4')->nullable();
            $table->text('tittle4_content')->nullable();
            $table->string('tittle5')->nullable();
            $table->text('tittle5_content')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
