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
        Schema::create('locations', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->json('images');
            $table->char('cep', 8);
            $table->string('address', 255);
            $table->string('address_number', 20);
            $table->string('neighborhood', 100);
            $table->string('city', 100);
            $table->char('state', 2);
            $table->string('phone', 20)->nullable();
            $table->string('contact_email', 100);
            $table->string('category');
            $table->json('features')->nullable();
            $table->json('working_hours')->nullable();
            $table->string('user_name');
            $table->integer('user_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
