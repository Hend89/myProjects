
<?php

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->dateTime('last_login');
            $table->string('phone_no');
            $table->date('dob');
            $table->string('address');
            $table->string('country')->nullable();
            $table->string('city');
            $table->string('image')->default('avatar-default.jpg');
            $table->integer('status')->nullable();;
            $table->string('bio')->nullable();;
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
