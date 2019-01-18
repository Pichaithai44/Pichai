<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('file', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->string('file_code');
            $table->string('originalName');
            $table->string('mimeType');
            $table->integer('size');
            $table->text('hashName')->nullable();
            $table->string('extension');
            $table->string('dirname')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
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
        Schema::drop('file');
    }
}
