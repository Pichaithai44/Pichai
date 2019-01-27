<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('personal_code', 64);
            $table->string('personal_title_name', 100);
            $table->string('personal_first_name', 100);
            $table->string('personal_last_name', 150);
            $table->string('personal_citizen_id', 13);
            $table->longText('personal_xml');
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
        Schema::dropIfExists('personals');
    }
}
