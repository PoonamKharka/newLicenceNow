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
        Schema::create('learner_profile_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('dob');
            $table->unsignedBigInteger('age')->default('0');
            $table->string('std_code')->default('+61');
            $table->bigInteger('phoneNo')->nullable();
            $table->binary('profile_picture')->nullable();
            $table->string('corresponding_address')->nullable();
            $table->unsignedBigInteger('blood_group_id');
            $table->foreign('blood_group_id')->references('id')->on('blood_groups');
            $table->date('course_start');
            $table->date('course_end')->nullable();
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learner_profile_details');
    }
};
