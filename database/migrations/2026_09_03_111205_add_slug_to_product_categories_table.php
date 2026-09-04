<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add slug first without unique constraint
        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        // Generate slugs for existing categories
        $categories = DB::table('product_categories')
            ->orderBy('id')
            ->get();

        foreach ($categories as $category) {

            $slug = Str::slug($category->name);

            $originalSlug = $slug;
            $counter = 1;

            // Make slug unique
            while (
                DB::table('product_categories')
                    ->where('slug', $slug)
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            DB::table('product_categories')
                ->where('id', $category->id)
                ->update([
                    'slug' => $slug
                ]);
        }

        // Add unique constraint after all existing records have slugs
        Schema::table('product_categories', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropUnique('product_categories_slug_unique');
            $table->dropColumn('slug');
        });
    }
};