<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeductionGuardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deduction_guard', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deduction_id')->unsigned();
            $table->string('guard_id');
            $table->timestamp('date')->nullable();
            $table->decimal('amount', 10, 2);
            $table->text('details');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('deduction_id')->references('id')->on('deductions')
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
        Schema::dropIfExists('deduction_guard');
    }
}
