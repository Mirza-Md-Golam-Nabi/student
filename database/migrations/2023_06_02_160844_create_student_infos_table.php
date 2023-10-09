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
        Schema::create('student_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('root_id');
            $table->foreign('root_id')->references('id')->on('users');
            $table->string('name', 191);
            $table->string('phone', 20)->nullable();
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('class_names');
            $table->string('father_name', 191)->nullable();
            $table->string('mother_name', 191)->nullable();
            $table->string('school_name', 191)->nullable();
            $table->string('father_phone', 20)->nullable();
            $table->string('mother_phone', 20)->nullable();
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
        Schema::dropIfExists('student_infos');
    }
};
