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
        Schema::table('donations', function (Blueprint $table) {
            $table->renameColumn('cashify_transaction_id', 'casaku_transaction_id');
            $table->renameColumn('cashify_qr_string', 'casaku_qr_string');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->renameColumn('casaku_transaction_id', 'cashify_transaction_id');
            $table->renameColumn('casaku_qr_string', 'cashify_qr_string');
        });
    }
};
