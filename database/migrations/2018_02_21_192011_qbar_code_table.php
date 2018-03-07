<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QbarCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('qbar_code', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->longText('filebase64')->charset('ascii')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::drop('qbar_code');
    }
}
