<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("user_id")->constrained("users");
            $table->bigInteger("like")->default(0);
            $table->string('photo')->nullable();
            $table->string('text')->nullable();
            $table->bigInteger("reposted_user_id")->constrained("users")->nullable();
            $table->timestamps();
        });
    }

    /**
     * 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_posts');
    }
}
