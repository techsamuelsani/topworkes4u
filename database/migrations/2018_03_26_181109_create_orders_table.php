<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {



            $table->increments('id');
            $table->string('status',20)->default(0);
            $table->integer('user_id')->index()->unsigned();
            $table->string('type',20);
            $table->integer('offer_id')->index()->nullable()->unsigned();
            $table->integer('package_id')->index()->nullable()->unsigned();
            $table->integer('revisions')->default(0);
            $table->timestamps();
        });

        Schema::table('orders', function($table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
