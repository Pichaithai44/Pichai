<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LotTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('lkup_lot_tag', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->string('part_no')->unique();
            $table->string('part_name');
            $table->integer('model_id')->unsigned();
            $table->foreign('model_id')->references('id')->on('lkup_model');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('lkup_type');
            $table->integer('material_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('lkup_material');
            $table->decimal('material_t',4,2)->nullable();
            $table->string('material_rod')->nullable();
            $table->string('refer')->nullable();
            $table->string('rev',10);
            $table->string('rev_date');
            $table->integer('barcode_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->enum('is_enable', ['Y', 'N']);
            $table->dropForeign(['model_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['material_id']);
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
        Schema::drop('lkup_lot_tag');
    }
}
