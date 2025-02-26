<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorProfileDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_profile_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('std_code')->default('+61');
            $table->unsignedBigInteger('phoneNo')->unique();
            $table->binary('profile_picture')->nullable();
            $table->string('contact_address');
            $table->date('date_of_birth');
            $table->date('date_of_joining');
            $table->date('date_of_termination')->nullable();
            $table->string('driving_expirence');
            $table->unsignedBigInteger('blood_group_id');
            $table->foreign('blood_group_id')->references('id')->on('blood_groups');
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('languages');
            $table->boolean('isAuto');
            $table->boolean('isManual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructor_profile_details');
    }
}
