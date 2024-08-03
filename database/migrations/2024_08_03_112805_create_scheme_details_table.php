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
        Schema::create('scheme_details', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_scheme')->nullable();
            $table->string('location_of_scheme')->nullable();
            $table->text('land_details')->nullable();
            $table->string('developer_name')->nullable();
            $table->string('architect_name')->nullable();
            $table->string('name_of_slum_developer')->nullable();
            $table->string('numbering_annexure_two')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('upload_cancelled_cheque')->nullable();
            $table->string('period_of_rent')->nullable();
            $table->string('amount_to_pay')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('balance_amount')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheme_details');
    }
};
