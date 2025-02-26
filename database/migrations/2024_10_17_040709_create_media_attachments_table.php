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
        Schema::create('media_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructor_request_id');
            $table->foreign('instructor_request_id')->references('id')->on('instructor_requests')->onDelete('cascade');   
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->enum('file_status', ['pending', 'approve', 'hold', 'rejected'])->default('pending');       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_attachments');
    }
};