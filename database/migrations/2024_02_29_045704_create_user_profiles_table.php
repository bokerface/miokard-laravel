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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->text('photo')->nullable();
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable();
            $table->text('origin_address')->nullable();
            $table->text('residence_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('student_id')->nullable();
            $table->smallInteger('entry_year')->nullable();
            // $table->string('status')->nullable();
            $table->string('sip_id')->nullable();
            $table->string('str_id')->nullable();
            $table->string('bpjs_id')->nullable();
            $table->string('bank_account')->nullable();
            $table->smallInteger('age')->nullable();
            $table->timestamps();
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
