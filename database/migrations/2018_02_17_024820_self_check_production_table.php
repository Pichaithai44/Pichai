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
            $table->text('neck_broken')->nullable();
            $table->text('burr')->nullable();
            $table->text('work_example')->nullable();
            // $table->enum('neck_broken', ['Y', 'N'])->nullable();
            // $table->enum('burr', ['Y', 'N'])->nullable();
            // $table->enum('work_example', ['Y', 'N'])->nullable();
            $table->text('issue_detail')->nullable();
            $table->text('issue_more_detail')->nullable();
            $table->enum('at_shlft', ['01', '02']);
            $table->text('production_status');//W = wait,C = checked
            $table->text('pqa_status');//W = wait,C = checked
            $table->text('production_quality_result');//W = Wait,T = Check through, F = Check failed
            $table->text('pqa_quality_result');//W = Wait,T = Check through, F = Check failed
            $table->enum('job_type',['SP', 'A','S','SCR'])->nullable();//SP = Semi Part, A = F/G Assembly, S = F/G Stemping, SCR = Special Case as The Customer Requirement
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
