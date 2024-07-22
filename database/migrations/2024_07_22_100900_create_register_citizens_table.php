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
        Schema::create('register_citizens', function (Blueprint $table) {
            $table->id();
            $table->string('citizen_first_name')->nullable();
            $table->string('citizen_middle_name')->nullable();
            $table->string('citizen_last_name')->nullable();
            $table->string('citizen_mobile_no')->nullable();
            $table->string('citizen_email')->nullable();
            $table->text('citizen_address')->nullable();
            $table->string('citizen_username')->nullable();
            $table->string('password')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_citizens');
    }
};
