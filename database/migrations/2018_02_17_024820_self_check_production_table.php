<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SelfCheckProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('self_check_production', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('pre_production_check_id');
            $table->integer('production_order');
            $table->string('lot_no_fix');
            $table->string('lot_no');
            $table->string('production_date');
            $table->string('quality_important')->nullable();
            $table->enum('is_rm_type_thickness', ['Y', 'N']);
            $table->string('rm_type')->nullable();
            $table->string('rm_thickness')->nullable();
            $table->enum('is_issue', ['Y', 'N']);
            $table->string('issue_detail')->nullable();
            $table->enum('is_issue_more', ['Y', 'N']);
            $table->string('issue_more_detail')->nullable();
            $table->enum('at_shlft', ['01', '02']);
            $table->enum('production_status', ['W', 'C']);//W = wait, C = checked
            $table->enum('pqa_status', ['W', 'C']);//W = wait, C = checked
            $table->enum('production_quality_result', ['T', 'F']);//T = Check through, F = Check failed
            $table->enum('pqa_quality_result', ['T', 'F']);//T = Check through, F = Check failed
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->enum('is_enable', ['Y', 'N']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('self_check_production');
    }
}
