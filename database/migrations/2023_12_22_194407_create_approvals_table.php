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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('approvable_id');
            $table->string('approvable_type');
            $table->unsignedBigInteger('approval_stage_id');
            $table->enum('status', ['Pending', 'Approved', 'Denied'])->default('Pending');
            $table->timestamps();
            $table->foreign('approval_stage_id')->references('id')->on('approval_stages')->onDelete('cascade');
            $table->unique(['approvable_id', 'approvable_type', 'approval_stage_id'], 'unique_approvals_per_selection_stage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
