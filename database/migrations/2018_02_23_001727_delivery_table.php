<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('delivery', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('lot_tag_id')->unsigned();
            $table->foreign('lot_tag_id')->references('id')->on('lkup_lot_tag');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->decimal('quantity',8,2);
            $table->integer('barcode_id')->unsigned();
            $table->foreign('barcode_id')->references('id')->on('qbar_code');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->enum('is_enable', ['Y', 'N']);
            $table->dropForeign(['lot_tag_id']);
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['barcode_id']);
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
        Schema::drop('delivery');
    }
}
