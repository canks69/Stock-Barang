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
        Schema::create('purchasedetail', function (Blueprint $table) {
            $table->id();
            $table->string('transno');
            $table->unsignedBigInteger('stock_id');
            $table->string('qty')->default(0);
            $table->string('price')->default(0);
            $table->string('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasedetail');
    }
};
