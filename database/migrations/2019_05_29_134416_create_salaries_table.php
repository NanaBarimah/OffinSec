<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guard_id');
            $table->decimal('amount', 10, 2);
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('account_number');
            $table->decimal('total_deductions');
            $table->date('month');
<<<<<<< HEAD
            $table->smallInteger('status')->default(0);
=======
            $table->tinyInteger('status');
>>>>>>> 4b214da868a4c879b7cc551f12f008dc9a41006e
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('salaries');
    }
}
