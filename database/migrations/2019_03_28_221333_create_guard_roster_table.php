<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardRosterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guard_roster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guard_id');
            $table->integer('duty_roster_id')->unsigned();
            $table->integer('shift_type_id')->unsigned();
            $table->string('day');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('guard_id')->references('id')->on('guards')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('duty_roster_id')->references('id')->on('duty_rosters')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('shift_type_id')->references('id')->on('shift_types')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guard_roster');
    }
}
