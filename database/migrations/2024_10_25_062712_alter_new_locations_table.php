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
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['street', 'city', 'state', 'postcode', 'country', 'created_at', 'updated_at']);
            $table->string('suburb');
            $table->string('stateCode');
            $table->integer('postcode');
            $table->decimal('latitude', 6, 3);
            $table->decimal('longitude', 6, 3);
            $table->string('country')->default('Australia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            //
        });
    }
};
