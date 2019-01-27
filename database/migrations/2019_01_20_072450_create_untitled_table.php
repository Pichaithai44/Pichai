<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUntitledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('untitled', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code', 64);
            $table->string('personal_code', 64);
            $table->string('payment_code', 64);
            $table->string('pay_ref', 100);
            $table->string('payment_type');
            $table->float('debt_payment', 8, 2);
            $table->date('due_date');
            $table->dateTime('date_payment');
            $table->enum('is_active', [0, 1])->default(1);
            $table->string('created_by', 64);
            $table->string('updated_by', 64)->nullable();
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
        Schema::dropIfExists('untitled');
    }
}
