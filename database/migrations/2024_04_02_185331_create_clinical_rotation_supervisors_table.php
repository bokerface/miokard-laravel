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
        Schema::create('clinical_rotation_supervisors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinical_rotation_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });

        Schema::table('clinical_rotation_supervisors', function (Blueprint $table) {
            $table->foreign('clinical_rotation_id')->references('id')->on('clinical_rotations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinical_rotation_supervisors');
    }
};
