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
        Schema::table('properties', function (Blueprint $table): void {
            if (! Schema::hasColumn('properties', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('neighborhood');
            }

            if (! Schema::hasColumn('properties', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }

            if (! Schema::hasColumn('properties', 'agent_id')) {
                $table->foreignId('agent_id')->nullable()->after('status');
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
                $table->dropColumn('agent_id');
            }

            if (Schema::hasColumn('properties', 'latitude')) {
                $table->dropColumn('latitude');
            }

            if (Schema::hasColumn('properties', 'longitude')) {
                $table->dropColumn('longitude');
            }
        });
    }
};
