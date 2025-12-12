<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('campsite_id')->constrained('campsites')->cascadeOnDelete();

            // customer info
            $table->string('customer_name', 150);
            $table->string('customer_email', 150);
            $table->string('customer_phone', 50);

            // booking date
            $table->date('start_date');
            $table->date('end_date');

            // status: pending, approved, rejected
            $table->integer('status', )->default(1); //['1 = pending', '2 = diproses', '3 = ditolak', '4 = selesai']
            // bukti pembayaran
            $table->string('payment_proof')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
