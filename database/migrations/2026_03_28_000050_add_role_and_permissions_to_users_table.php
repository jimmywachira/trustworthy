<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('role', 30)->default('user')->after('is_admin')->index();
            $table->json('permissions')->nullable()->after('role');
        });

        DB::table('users')
            ->where('is_admin', true)
            ->update([
                'role' => 'admin',
                'permissions' => json_encode(['*']),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['role', 'permissions']);
        });
    }
};
