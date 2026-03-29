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
        Schema::create('land_listings', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('reference_code')->nullable()->unique();
            $table->decimal('price', 14, 2);
            $table->decimal('price_per_acre', 14, 2)->nullable();
            $table->string('city', 120)->default('Nairobi');
            $table->string('neighborhood', 120);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('parcel_size_acres', 10, 2);
            $table->string('zoning', 120)->nullable();
            $table->string('tenure_type', 120)->nullable();
            $table->string('title_deed_status', 120)->nullable();
            $table->string('road_access', 120)->nullable();
            $table->json('utilities')->nullable();
            $table->string('permitted_use', 160)->nullable();
            $table->string('topography', 120)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 40)->default('available');
            $table->boolean('featured')->default(false);
            $table->foreignId('agent_id')->nullable()->constrained('agents')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_listings');
    }
};
