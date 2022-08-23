<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('username',50)->nullable()->unique();
            $table->date('dob')->nullable();
            $table->unsignedDecimal('balance')->default(0);
            $table->string('picLink',200)->default('default.jpg');
            $table->dateTime('lastOnline')->nullable();
            $table->string('email',100)->unique();
            $table->string('password',200);
            $table->string('type',20)->default("buyer");
            $table->string('city',30)->nullable();
            $table->string('state',40)->nullable();
            $table->string('address',100)->nullable();
            $table->string('zip',10)->nullable();
            $table->string('country',30)->nullable();
            $table->string('phone',20)->nullable();
            $table->integer('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
