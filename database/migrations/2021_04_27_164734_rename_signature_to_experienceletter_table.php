<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSignatureToExperienceletterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experience_letters', function (Blueprint $table) {
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
        Schema::table('experience_letters', function (Blueprint $table) {
            $table->renameColumn('digital_signature_id', 'signature');
        });
    }
}
