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
        Schema::create('address', function (Blueprint $table) {
            $table->integer('Id', true); // Auto-incrementing primary key
            $table->string('Type', 50)->nullable();
            $table->string('AccountCode', 10)->nullable();
            $table->string('CompanyName', 100)->nullable();
            $table->string('ALine1', 100)->nullable();
            $table->string('ALine2', 100)->nullable();
            $table->string('Location', 100)->nullable();
            $table->string('Pincode', 16)->nullable();
            $table->string('StateCode', 10)->nullable();
            $table->string('State', 50)->nullable();
            $table->string('Country', 50)->nullable();
            $table->string('PAN', 15)->nullable();
            $table->string('GSTNo', 16)->nullable();
            $table->string('ContactName', 100)->nullable();
            $table->string('Phone', 50)->nullable();
            $table->string('Email', 100)->nullable();
            $table->integer('CreditDays')->default(30);
            $table->string('CreateBy', 50)->nullable();
            $table->dateTime('CreateDate')->nullable();
            $table->string('ModifyBy', 50)->nullable();
            $table->dateTime('ModifyDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
