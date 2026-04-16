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
        Schema::create('expense', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('CCode', 10);
            $blueprint->string('Category', 50)->nullable();
            $blueprint->string('JobNo', 50);
            $blueprint->date('Date')->nullable();
            $blueprint->string('Reference', 255)->nullable();
            $blueprint->string('Description', 500)->nullable();
            $blueprint->string('AccountCode', 50)->nullable();
            $blueprint->string('CompanyName', 100)->nullable();
            $blueprint->string('MAWB_MBL', 50)->nullable();
            $blueprint->string('Currency', 50)->nullable();
            $blueprint->decimal('ExRate', 5, 2)->nullable();
            $blueprint->decimal('Total', 8, 2)->nullable();
            $blueprint->string('Month', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense');
    }
};
