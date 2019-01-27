<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code', 64);
            $table->string('personal_code', 64);
            $table->string('product_name', 255);
            $table->text('product_detail');
            $table->float('product_capital');
            $table->float('product_interest');
            $table->dateTime('product_start_date');
            $table->dateTime('product_end_date');
            $table->longText('product_xml');
            $table->enum('is_active', [0, 1])->default(1);
            $table->string('created_by', 64);
            $table->string('updated_by', 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
