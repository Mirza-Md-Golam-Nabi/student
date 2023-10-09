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
        Schema::create('cls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('root_id');
            $table->foreign('root_id')->references('id')->on('users');
            $table->unsignedBigInteger('class_name_id');
            $table->foreign('class_name_id')->references('id')->on('class_names');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cls');
    }
};
