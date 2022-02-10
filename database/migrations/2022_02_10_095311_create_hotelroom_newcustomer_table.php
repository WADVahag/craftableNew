<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelroomNewcustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotelroom_newcustomer', function (Blueprint $table) {
            
            $table->bigInteger('hotelroom_id')->unsigned();
            $table->foreign('hotelroom_id')
                ->references('id')
                ->on('hotelrooms')
                ->onDelete('cascade');
            $table->biginteger('newcustomer_id')->unsigned();
            $table->foreign('newcustomer_id')
                ->references('id')
                ->on('newcustomers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotelroom_newcustomer');
    }
}
