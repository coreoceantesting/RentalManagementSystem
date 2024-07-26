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
        Schema::create('complaint_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('complaint_id')->nullable();
            $table->enum('overall_status', ['Pending', 'Approved', 'Rejected', 'Resolved', 'Closed', 'Work Stopped', 'Send To Collector', 'Inprogress'])->default('Pending');
            $table->enum('status', ['Pending', 'Explanation Call Send', 'Send For Hearing', 'Resolved', 'Closed', 'Work Stopped','Send For Stop Work'])->default('Pending');
            $table->date('explanation_call_one_at')->nullable();
            $table->integer('explanation_call_one_by')->nullable();
            $table->string('explanation_doc_one')->nullable();
            $table->string('explanation_subject_one')->nullable();
            $table->date('explanation_call_two_at')->nullable();
            $table->integer('explanation_call_two_by')->nullable();
            $table->string('explanation_doc_two')->nullable();
            $table->string('explanation_subject_two')->nullable();
            $table->date('explanation_call_three_at')->nullable();
            $table->integer('explanation_call_three_by')->nullable();
            $table->string('explanation_doc_three')->nullable();
            $table->string('explanation_subject_three')->nullable();
            $table->string('contractor_explanation_doc_one')->nullable();
            $table->string('contractor_explanation_doc_two')->nullable();
            $table->string('contractor_explanation_doc_three')->nullable();
            $table->string('hearing_doc')->nullable();
            $table->string('hearing_place')->nullable();
            $table->string('hearing_subject')->nullable();
            $table->datetime('hearing_datetime')->nullable();
            $table->integer('send_to_collector_by')->nullable();
            $table->datetime('send_to_collector_at')->nullable();
            $table->string('send_to_collector_remark')->nullable();
            $table->integer('approval_by')->nullable();
            $table->datetime('approval_at')->nullable();
            $table->string('stop_work_subject')->nullable();
            $table->string('stop_work_doc')->nullable();
            $table->integer('stop_work_approval_by')->nullable();
            $table->datetime('stop_work_approval_at')->nullable();
            $table->integer('close_complaint_by')->nullable();
            $table->datetime('close_complaint_at')->nullable();
            $table->string('close_complaint_remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_statuses');
    }
};
