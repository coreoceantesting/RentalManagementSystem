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
            $table->enum('stopwork_status_by_register', ['Pending', 'Approved', 'Rejected'])->default('Pending')->after('stop_work_approval_at');
            $table->date('stopwork_approval_at_by_register')->after('stopwork_status_by_register')->nullable();
            $table->string('stopwork_approval_remark_by_register')->after('stopwork_approval_at_by_register')->nullable();
            $table->integer('stopwork_approval_by_register_id')->after('stopwork_approval_remark_by_register')->nullable();
            $table->enum('stopwork_status_by_secretory', ['Pending', 'Approved', 'Rejected'])->default('Pending')->after('stopwork_approval_by_register_id');
            $table->date('stopwork_approval_at_by_secretory')->after('stopwork_status_by_secretory')->nullable();
            $table->string('stopwork_approval_remark_by_secretory')->after('stopwork_approval_at_by_secretory')->nullable();
            $table->integer('stopwork_approval_by_secretory_id')->after('stopwork_approval_remark_by_secretory')->nullable();
            $table->enum('stopwork_status_by_ceo', ['Pending', 'Approved', 'Rejected'])->default('Pending')->after('stopwork_approval_by_secretory_id');
            $table->date('stopwork_approval_at_by_ceo')->after('stopwork_status_by_ceo')->nullable();
            $table->string('stopwork_approval_remark_by_ceo')->after('stopwork_approval_at_by_ceo')->nullable();
            $table->integer('stopwork_approval_by_ceo_id')->after('stopwork_approval_remark_by_ceo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_statuses', function (Blueprint $table) {
            $table->dropColumn('stopwork_status_by_register');
            $table->dropColumn('stopwork_approval_at_by_register');
            $table->dropColumn('stopwork_approval_remark_by_register');
            $table->dropColumn('stopwork_approval_by_register_id');
            $table->dropColumn('stopwork_status_by_secretory');
            $table->dropColumn('stopwork_approval_at_by_secretory');
            $table->dropColumn('stopwork_approval_remark_by_secretory');
            $table->dropColumn('stopwork_approval_by_secretory_id');
            $table->dropColumn('stopwork_status_by_ceo');
            $table->dropColumn('stopwork_approval_at_by_ceo');
            $table->dropColumn('stopwork_approval_remark_by_ceo');
            $table->dropColumn('stopwork_approval_by_ceo_id');
        });
    }
};
