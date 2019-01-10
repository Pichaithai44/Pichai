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
            $table->string('product_num', 64);
            $table->string('date_payment', 100);
            $table->string('slip_no', 100);
            $table->string('capital', 150);
            $table->string('interest', 13);
            $table->enum('is_active', [0, 1]);
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
