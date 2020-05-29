<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up () {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('conversation_id')->unsigned();
            $table->bigInteger('sender_id')->unsigned();
            $table->text('message');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down () {
        Schema::dropIfExists('messages');
    }
}
