<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guards', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('dob');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('occupation');
            $table->string('address');
            $table->string('national_id');
            $table->string('phone_number');
            $table->string('SSNIT')->nullable();
            $table->string('emergency_contact');
            $table->string('photo');
            $table->string('bank_name');
            $table->string('account_number');
            $table->boolean('welfare')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guards');
    }
}
