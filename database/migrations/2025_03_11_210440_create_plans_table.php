<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_tittle');// Plan name (Basic, Standard, Premium)
            $table->decimal('amount', 10, 2); // Plan price
            $table->string('currency')->default('USD'); // Currency (default: USD)
            $table->text('content1')->nullable();
            $table->string('titttle1')->nullable();
            $table->string('button1_name')->nullable();
            $table->string('button1_url')->nullable();
            $table->string('button2_name')->nullable();
            $table->string('button2_url')->nullable();
            $table->foreignId('package_id')->constrained()->onDelete('cascade'); // Plan belongs to a package
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
