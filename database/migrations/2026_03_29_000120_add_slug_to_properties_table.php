<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table): void {
            if (! Schema::hasColumn('properties', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('title');
            }
        });

        $properties = DB::table('properties')->select('id', 'title')->orderBy('id')->get();

        foreach ($properties as $property) {
            $base = Str::slug((string) $property->title);
            $slug = $base !== '' ? $base : 'property-'.$property->id;
            $originalSlug = $slug;
            $counter = 2;

            while (DB::table('properties')
                ->where('slug', $slug)
                ->where('id', '!=', $property->id)
                ->exists()) {
                $slug = $originalSlug.'-'.$counter;
                $counter++;
            }

            DB::table('properties')->where('id', $property->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table): void {
            if (Schema::hasColumn('properties', 'slug')) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            }
        });
    }
};
