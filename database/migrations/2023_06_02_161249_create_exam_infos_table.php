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
        Schema::create('exam_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('root_id');
            $table->foreign('root_id')->references('id')->on('users');
            $table->string('name');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('class_names');
            $table->float('total_marks');
            $table->text('topic')->nullable();
            $table->date('exam_date');
            $table->string('status', 1)->default(1);
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
        Schema::dropIfExists('exam_infos');
    }
};
