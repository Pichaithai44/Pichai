<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pawn_name', 255); // ชื่อโรงรับจำนำ
            $table->string('address', 255)->nullable(); // ที่อยู่
            $table->string('moo', 100)->nullable(); // หมู่  
            $table->string('soi', 100)->nullable(); // ซอย  
            $table->string('road', 100)->nullable(); // ถนน
            $table->string('sub_district', 100)->nullable(); // ตำบล / แขวง
            $table->string('district', 100)->nullable(); // อำเภอ / เขต
            $table->string('province', 100)->nullable(); // จังหวัด 
            $table->string('postal_code', 50)->nullable(); // รหัสไปรษณีย์ 
            $table->string('tel', 100)->nullable(); // เบอร์โทร 
            $table->float('interest_rate', 8, 2)->unsigned()->nullable(); // อัตตราดอกเบี้ย 
            $table->integer('owe')->unsigned()->nullable(); // ค้างชำระ
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
        Schema::dropIfExists('systems');
    }
}
