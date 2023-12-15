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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('name');
            $table->string('item_number')->nullable();
            $table->string('supplier')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('color')->nullable();
            $table->string('notes')->nullable();
            $table->index('team_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
