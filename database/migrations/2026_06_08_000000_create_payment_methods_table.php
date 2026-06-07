<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('type'); // qris, bank
            $table->string('logo')->nullable();
            $table->string('qris_image')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Insert default payment methods
        DB::table('payment_methods')->insert([
            [
                'name' => 'QRIS (GoPay, OVO, Dana, LinkAja)',
                'code' => 'qris',
                'type' => 'qris',
                'logo' => null,
                'qris_image' => '/images/qris.png',
                'bank_name' => null,
                'bank_account_number' => null,
                'bank_account_name' => null,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Transfer Bank (Nobu Bank)',
                'code' => 'bank_nobu',
                'type' => 'bank',
                'logo' => null,
                'qris_image' => null,
                'bank_name' => 'NOBU BANK',
                'bank_account_number' => '1031-0988-1234',
                'bank_account_name' => 'Yayasan Pedulia',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
