<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
			  	$table->string('name');
			  	$table->string('address');
			  	$table->string('email')->unique();
			  	$table->string('phone');
			   $table->timestamps();

			   $table->foreign('user_id')
					->references('id')
					->on('users')
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
		 //$table->dropForeign('barbers_user_id_foreign');
        Schema::dropIfExists('barbers');
    }
}
