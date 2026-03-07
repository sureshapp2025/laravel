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
        Schema::table('products', function (Blueprint $table) {
            $table->string('c_code')->nullable();
            $table->string('particulars')->nullable();
            $table->string('hsn')->nullable();
            $table->decimal('gst', 8, 2)->nullable();
            $table->decimal('igst', 8, 2)->nullable();
            $table->decimal('cgst', 8, 2)->nullable();
            $table->decimal('sgst', 8, 2)->nullable();
            $table->boolean('except_particulars')->default(0);
            $table->boolean('is_service')->default(0);
            $table->boolean('active')->default(1);

            // Removing old columns if they exist (name, detail)
            if (Schema::hasColumn('products', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('products', 'detail')) {
                $table->dropColumn('detail');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'c_code', 'particulars', 'hsn', 'gst', 'igst', 'cgst', 'sgst', 
                'except_particulars', 'is_service', 'active'
            ]);
            $table->string('name')->nullable();
            $table->text('detail')->nullable();
        });
    }
};
