<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned();
            $table->string('guard_id');
            $table->string('image');
            $table->dateTime('date_time');
            $table->smallInteger('type')->default(1);
            $table->smallInteger('status')->default(2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('site_id')->references('id')->on('sites')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('guard_id')->references('id')->on('guards')
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
        Schema::dropIfExists('attendance_requests');
    }
}
