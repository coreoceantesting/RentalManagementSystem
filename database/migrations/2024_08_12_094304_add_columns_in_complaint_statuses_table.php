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
        Schema::table('complaint_statuses', function (Blueprint $table) {
            $table->string('contractor_explanation_remark_one')->after('contractor_explanation_doc_one')->nullable();
            $table->date('contractor_explanation_one_at')->after('contractor_explanation_remark_one')->nullable();
            $table->integer('contractor_explanation_one_by')->after('contractor_explanation_one_at')->nullable();
            $table->string('contractor_explanation_remark_two')->after('contractor_explanation_doc_two')->nullable();
            $table->date('contractor_explanation_two_at')->after('contractor_explanation_remark_two')->nullable();
            $table->integer('contractor_explanation_two_by')->after('contractor_explanation_two_at')->nullable();
            $table->string('contractor_explanation_remark_three')->after('contractor_explanation_doc_three')->nullable();
            $table->date('contractor_explanation_three_at')->after('contractor_explanation_remark_three')->nullable();
            $table->integer('contractor_explanation_three_by')->after('contractor_explanation_three_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_statuses', function (Blueprint $table) {
            $table->dropColumn('contractor_explanation_remark_one');
            $table->dropColumn('contractor_explanation_one_at');
            $table->dropColumn('contractor_explanation_one_by');
            $table->dropColumn('contractor_explanation_remark_two');
            $table->dropColumn('contractor_explanation_two_at');
            $table->dropColumn('contractor_explanation_two_by');
            $table->dropColumn('contractor_explanation_remark_three');
            $table->dropColumn('contractor_explanation_three_at');
            $table->dropColumn('contractor_explanation_three_by');
        });
    }
};
