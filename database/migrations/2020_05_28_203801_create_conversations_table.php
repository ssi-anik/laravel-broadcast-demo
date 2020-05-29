<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    public function up () {
        Schema::create('conversations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('by')->unsigned();
            $table->bigInteger('with')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down () {
        Schema::dropIfExists('conversations');
    }
}
