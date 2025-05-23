<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Feature name
            $table->foreignId('plan_id')->constrained()->onDelete('cascade'); // Feature belongs to a plan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('features');
    }
};
