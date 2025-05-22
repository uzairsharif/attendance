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
        Schema::table('attendance_corrections', function (Blueprint $table) {
            $table->string('requested_in_status')->nullable()->after('requested_check_in'); 
            $table->string('requested_out_status')->nullable()->after('requested_check_out');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_corrections', function (Blueprint $table) {
            $table->dropColumn('requested_in_status');
            $table->dropColumn('requested_out_status');
        });
    }
};
