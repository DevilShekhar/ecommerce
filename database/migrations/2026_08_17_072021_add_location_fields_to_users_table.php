<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)
                ->nullable()
                ->after('address');

            $table->decimal('longitude', 10, 7)
                ->nullable()
                ->after('latitude');

            $table->text('location_address')
                ->nullable()
                ->after('longitude');

            $table->string('city', 191)
                ->nullable()
                ->after('location_address');

            $table->string('state', 191)
                ->nullable()
                ->after('city');

            $table->string('country', 191)
                ->nullable()
                ->after('state');

            $table->string('pincode', 20)
                ->nullable()
                ->after('country');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'latitude',
                'longitude',
                'location_address',
                'city',
                'state',
                'country',
                'pincode',
            ]);
        });
    }
};
