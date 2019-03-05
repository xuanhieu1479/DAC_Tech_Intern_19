<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ug', function (Blueprint $table) {
            $table->string('user_name');
            $table->string('group_name');
            $table->primary(['user_name', 'group_name']);
            $table->foreign('user_name')->references('user_name')->on('users');
            $table->foreign('group_name')->references('group_name')->on('groups');
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
        Schema::dropIfExists('ug');
    }
}
