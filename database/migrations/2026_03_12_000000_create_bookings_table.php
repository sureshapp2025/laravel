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
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('Category')->nullable()->default('client address');
            $table->string('BookingNo')->unique();
            $table->date('booking_date');
            
            // Text fields
            $table->string('companyname')->nullable();
            $table->string('shipper')->nullable();
            $table->string('origin')->nullable();
            $table->string('Destination')->nullable();
            $table->string('MAWB_MBL')->nullable();
            $table->string('HAWB_HBL')->nullable();
            $table->string('Consignee')->nullable();
            $table->unsignedInteger('Pieces')->nullable();
            $table->string('ETD')->nullable(); // Can be string or date, user said "text field"
            $table->string('ETA')->nullable(); // Can be string or date, user said "text field"

            // New fields listed
            $table->string('accode_companyname')->nullable();
            $table->string('acode_Shipper')->nullable();
            $table->string('accode_consignee')->nullable();
            $table->string('IATA')->nullable();
            $table->string('SBNo')->nullable();
            $table->date('SBDate')->nullable();
            $table->string('ShipperInvoice')->nullable();
            $table->string('Line')->nullable();
            $table->string('IGM_EGM')->nullable();
            $table->decimal('CBM', 10, 3)->nullable();
            $table->decimal('GrWeight', 10, 3)->nullable();
            $table->decimal('ChWeight', 10, 3)->nullable();
            $table->string('Vessel')->nullable();
            $table->string('Volume')->nullable();
            $table->string('FCL')->nullable();
            $table->string('TOS')->nullable();
            $table->string('IEC')->nullable();
            $table->string('OOC')->nullable();
            $table->string('Asses')->nullable();
            $table->string('LUT')->nullable();
            $table->string('CFS')->nullable();
            $table->string('SalesRep')->nullable();
            $table->string('Reference')->nullable();
            $table->string('Month')->nullable();
            $table->string('Year')->nullable();
            
            $table->boolean('Active')->default(true);
            $table->string('CreateBy')->nullable();
            $table->timestamp('CreateDate')->nullable();
            $table->string('ModifyBy')->nullable();
            $table->timestamp('ModifyDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
