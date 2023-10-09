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
        Schema::create('sms_formats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_info_id');
            $table->foreign('exam_info_id')->on('exam_infos')->references('id');
            $table->string('number', 50);
            $table->string('text', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_formats');
    }
};
