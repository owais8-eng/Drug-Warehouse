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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('scentific_name');
            $table->string('trade_name');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('company');
            $table->integer('amount');
            $table-> integer('expiry_date');
            $table->integer('price');
            $table->timestamps();
        });
   
    
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
