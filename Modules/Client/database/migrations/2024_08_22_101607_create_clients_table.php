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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('facility_level', ['HCI', 'HCII', 'HCIII', 'HCIV', 'Clinic', 'Hospital', 'Referral Hospital']);
            $table->string('location');
            $table->string('email_for_invoices');
            $table->string('contact_person_name');
            $table->string('contact_person_phone');
            $table->integer('billing_cycle_in_years');
            $table->string('streamline_engineer_name');
            $table->string('streamline_engineer_phone');
            $table->string('streamline_engineer_email');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
