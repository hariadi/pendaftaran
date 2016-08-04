<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('ic')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('job_title')->nullable();
			$table->string('grade')->nullable();
			$table->integer('agency_id')->unsigned()->nullable();
			$table->foreign('agency_id')->references('id')->on('agencies');
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
        Schema::drop('participants');
    }
}
