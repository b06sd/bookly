<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
          $table->uuid('id');
          $table->primary('id');
          $table->uuid('user_id');
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->uuid('book_id');
          $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
          $table->enum('action_type', ['likes', 'dislike', 'unsure'])->default('unsure');
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
        Schema::dropIfExists('actions');
    }
}
