<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->increments('id');
            $table->text('address')->nullable();
            $table->text('bank_details')->nullable();
            $table->string('pan')->nullable();
            $table->string('gst_num')->nullable();
            $table->string('soft_tech_num')->nullable();
            $table->text('other_details')->nullable();
            $table->string('moa_aoa')->nullable();
            $table->string('mca_certificate')->nullable();
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
        Schema::dropIfExists('company_details');
    }
}
