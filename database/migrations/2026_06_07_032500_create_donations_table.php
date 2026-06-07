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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->string('donor_name');
            $table->string('donor_email');
            $table->unsignedBigInteger('nominal');
            $table->integer('unique_code');
            $table->unsignedBigInteger('total_amount');
            $table->string('payment_method'); // qris, bank_nobu
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->text('comment')->nullable();
            $table->boolean('is_comment_visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
