<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaryslips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('department')->nullable();
            $table->date('month_year')->nullable();
            $table->string('pan')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('basic')->nullable();
            $table->integer('da')->nullable();
            $table->integer('hra')->nullable();
            $table->integer('conveyance_allow')->nullable();
            $table->integer('education_allow')->nullable();
            $table->integer('medical_allow')->nullable();
            $table->integer('internet_allow')->nullable();
            $table->integer('special_allow')->nullable();
            $table->integer('p_fund')->nullable();
            $table->integer('taxes')->nullable();
            $table->string('pdf_name')->nullable();
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
        Schema::dropIfExists('salaryslips');
    }
}
