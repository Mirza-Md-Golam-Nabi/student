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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('root_id');
            $table->foreign('root_id')->references('id')->on('users');
            $table->unsignedBigInteger('exam_info_id');
            $table->foreign('exam_info_id')->references('id')->on('exam_infos');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('student_infos');
            $table->float('get_marks');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
