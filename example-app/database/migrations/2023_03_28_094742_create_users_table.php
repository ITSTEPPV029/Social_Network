<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nick_name')->nullable();//->unique();
            $table->string('email');//->unique();
            $table->string('avatar')->default('/storage/uploads/anonym.png');//public
            $table->boolean('admin')->default(false); 
           // $table->float('latitude')->nullable();
           // $table->float('longitude')->nullable();
            $table->double('latitude', 16, 14)->nullable();
            $table->double('longitude', 16, 14)->nullable();
            
            $table->string('password');
            $table->string('remember_token')->nullable();

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
