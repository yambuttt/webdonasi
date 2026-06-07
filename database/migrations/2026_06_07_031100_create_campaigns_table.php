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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();
            $table->string('category')->default('kesehatan'); // kesehatan, bencana, pendidikan
            $table->longText('description');
            $table->unsignedBigInteger('target_amount');
            $table->unsignedBigInteger('current_amount')->default(0);
            $table->json('donation_options')->nullable();
            $table->string('status')->default('active'); // active, completed, draft
            $table->integer('days_remaining')->default(30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
