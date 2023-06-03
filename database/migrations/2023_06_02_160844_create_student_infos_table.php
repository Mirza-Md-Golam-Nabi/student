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
            $table->string('name', 191);
            $table->string('phone', 20);
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('class_names');
            $table->string('father_name', 191)->nullable();
            $table->string('mother_name', 191)->nullable();
            $table->string('school_name', 191)->nullable();
            $table->string('guardian_phone', 20)->nullable();
            $table->string('active', 1)->default(1);
            $table->timestamps();
            $table->softDeletes();
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
