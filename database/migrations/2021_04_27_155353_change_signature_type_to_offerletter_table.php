<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSignatureTypeToOfferletterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_letters', function (Blueprint $table) {
            $table->integer('digital_signature_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_letters', function (Blueprint $table) {
            $table->string('digital_signature_id')->nullable()->change();
        });
    }
}
