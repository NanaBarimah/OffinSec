<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_id');
            $table->string('guard_id');
            $table->decimal('amount', 10, 2);
            $table->boolean('active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::dropIfExists('client_salaries');
    }
}
