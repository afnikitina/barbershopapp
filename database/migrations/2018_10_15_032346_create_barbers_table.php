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
        Schema::table('barbers', function (Blueprint $table) {
			  $table->uuid('id');
			  $table->string('name');
			  $table->string('address');
			  $table->string('email')->unique();
			  $table->string('Phone');
			  $table->tinyInteger('ast')->unsigned()->default(30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barbers', function (Blueprint $table) {
			  Schema::dropIfExists('barbers');
        });
    }
}
