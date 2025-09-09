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
        Schema::table('staff', function (Blueprint $table) {
            $table->string('ni_number')->nullable()->after('phone')->comment('National Insurance Number');
            $table->string('utr_number')->nullable()->after('ni_number')->comment('Unique Tax Reference Number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn(['ni_number', 'utr_number']);
        });
    }
};
