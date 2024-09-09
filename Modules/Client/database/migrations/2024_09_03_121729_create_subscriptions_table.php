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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // Links to clients table
            $table->string('plan_name'); // Name of the subscribed plan
            $table->enum('billing_cycle', ['annually', '2_years', '3_years', '4_years', '5_years', '6_years', '7_years', '8_years']); // Billing cycle options
            $table->date('start_date'); // When the subscription started
            $table->date('next_billing_date'); // Next invoice date
            $table->decimal('amount', 10, 2); // Subscription amount
            $table->enum('status', ['paid', 'unpaid']); // Current status of the subscription

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
