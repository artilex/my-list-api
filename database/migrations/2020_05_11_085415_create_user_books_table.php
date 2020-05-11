<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_books', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('book_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('reding_state_id');
            $table->year('planned_year_of_reading')->nullable();
            $table->year('actual_year_of_reading')->nullable();
            $table->unsignedInteger('priority_number');

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
        Schema::dropIfExists('user_books');
    }
}
