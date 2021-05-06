<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDigitalSignatureIdToOfferletterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_letters', function (Blueprint $table) {
            $table->renameColumn('signature', 'digital_signature_id');
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
            $table->renameColumn('digital_signature_id', 'signature');
        });
    }
}
