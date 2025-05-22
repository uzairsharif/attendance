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
        Schema::create('attendance_corrections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_id'); // Foreign key to attendances table
            $table->timestamp('requested_check_in')->nullable();
            $table->timestamp('requested_check_out')->nullable();
            $table->text('reason');
            $table->string('status')->default('Pending'); // Status: Pending, Approved, Rejected
            $table->text('reviewer_comments')->nullable(); // Comments from HR/Manager
            $table->unsignedBigInteger('reviewed_by')->nullable(); // User ID of the reviewer
            $table->timestamps();

            $table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_corrections');
    }
};
