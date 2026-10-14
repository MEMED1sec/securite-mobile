<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create additives table
        Schema::create('additives', function (Blueprint $table) {
            $table->id();
            $table->string('e_number')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('risk_level')->nullable();
            $table->text('common_uses')->nullable();
            $table->timestamps();
        });

        // Create product_additive pivot table
        Schema::create('product_additive', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('additive_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_additive');
        Schema::dropIfExists('additives');
    }
};
