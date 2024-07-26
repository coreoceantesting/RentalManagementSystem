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
        Schema::create('complaint_details', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name')->nullable();
            $table->text('applicant_current_address')->nullable();
            $table->string('applicant_mobile_no')->nullable();
            $table->string('applicant_aadhar_no')->nullable();
            $table->string('original_no')->nullable();
            $table->string('original_is_eligible')->nullable();
            $table->string('appendix_no')->nullable();
            $table->string('appendix_is_eligible')->nullable();
            $table->string('appendix_doc')->nullable();
            $table->string('scheme_name')->nullable();
            $table->string('scheme_details')->nullable();
            $table->string('contractor_name')->nullable();
            $table->string('contractor_details')->nullable();
            $table->date('date_of_demolition')->nullable();
            $table->string('is_there_rental_agreement')->nullable();
            $table->date('date_of_agreement')->nullable();
            $table->string('monthly_rate_of_rent')->nullable();
            $table->string('is_developer_paid_earlier_rent')->nullable();
            $table->string('old_monthly_rate_of_rent')->nullable();
            $table->date('date_of_previous_rent_was')->nullable();
            $table->string('montly_received_rate')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('copy_of_bank_passbook')->nullable();
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
        Schema::dropIfExists('complaint_details');
    }
};
