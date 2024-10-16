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

        // Learner Driver Registration Table
        Schema::create('learner_profile_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date_of_birth')->nullable();
            $table->string('learner_pick_up_address')->nullable();
            $table->string('learner_state')->nullable();
            $table->unsignedBigInteger('learner_phone')->nullable();            
            $table->enum('registration_type', ['self', 'someone-else'])->default('self');           
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