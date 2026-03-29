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
        Schema::create('agents', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 30)->nullable();
            $table->string('specialty')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo_url')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });

        Schema::table('properties', function (Blueprint $table): void {
            if (Schema::hasColumn('properties', 'agent_id')) {
                $table->foreign('agent_id')->references('id')->on('agents')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table): void {
            if (Schema::hasColumn('properties', 'agent_id')) {
                $table->dropForeign(['agent_id']);
            }
        });

        Schema::dropIfExists('agents');
    }
};
