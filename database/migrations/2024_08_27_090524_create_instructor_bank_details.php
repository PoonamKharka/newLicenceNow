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
        Schema::create('instructor_bank_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('salary_pay_mode_id');
            $table->foreign('salary_pay_mode_id')->references('id')->on('salary_pay_modes');
            $table->string('salary_bank_name')->nullable();
            $table->string('salary_branch_name')->nullable();
            $table->string('salary_ifsc_code')->nullable();
            $table->unsignedBigInteger('salary_account_number')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('state');
            $table->unsignedBigInteger('postal_code');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_bank_details');
    }
};
