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
            $table->string('facility_level');
            $table->string('location');
            $table->string('contact_person_name');
            $table->string('contact_person_phone');
            $table->string('email_for_invoices');
            $table->string('billing_cycle');
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
