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
        Schema::create('table_learner_profile_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('id')->on('users');
            $table->bigInteger('std_code')->nullable();
            $table->bigInteger('phoneNo')->nullable();
            $table->string('corresponding_address')->nullable();
            $table->string('blood_group')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('expire_at')->nullable();
            $table->string('gender')->nullable();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_learner_profile_details');
    }
};
