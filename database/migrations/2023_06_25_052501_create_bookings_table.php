<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('doctorid');
            $table->integer('scheduleid');
            $table->string('patientemail');
            $table->string('patientphone');
            $table->string('patientname');
            $table->date('patientbirthday');
            $table->string('patientgender');
            $table->string('patientaddress');
            $table->string('patientdistrict');
            $table->string('patientprovince');
            $table->longText('details');
            $table->string('status');
            $table->longText('file');
            $table->timestamps();
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