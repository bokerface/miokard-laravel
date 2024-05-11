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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('clinical_rotation_id')->nullable();
            $table->unsignedBigInteger('student_clinical_rotation_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('file')->nullable();
            $table->text('presentation_file')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('clinical_rotation_id')->references('id')->on('clinical_rotations')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('student_clinical_rotation_id')->references('id')->on('student_clinical_rotations')->onDelete('cascade');
            // $table->foreign('task_type_id')->references('id')->on('task_types')->onDelete('cascade');
            // $table->foreign('examiner_id_1')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('examiner_id_2')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('advisor_id_1')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('advisor_id_2')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
