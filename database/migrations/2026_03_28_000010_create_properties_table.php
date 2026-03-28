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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 12, 2)->index();
            $table->string('city')->index();
            $table->string('neighborhood')->nullable();
            $table->enum('type', ['rent', 'sale'])->index();
            $table->unsignedTinyInteger('beds');
            $table->decimal('baths', 3, 1);
            $table->unsignedInteger('sqft');
            $table->enum('status', ['available', 'sold'])->default('available')->index();
            $table->json('amenities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
