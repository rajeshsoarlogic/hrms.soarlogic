<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOfferletters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('offer_letters', 'user_id'))
        {
            Schema::table('offer_letters', function (Blueprint $table)
            {
                $table->dropColumn('user_id');
            });
        }

        Schema::table('offer_letters', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('email')->after('name')->unique();
            $table->string('other_emails')->after('email')->nullable();
            $table->string('token')->nullable()->after('signature');
            $table->boolean('accepted')->default(0)->comment('accepted by candidate or not')->after('signature');
            $table->string('emp_signature')->nullable()->after('signature');
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
            $table->dropColumn(['name', 'email', 'other_emails', 'token', 'accepted', 'emp_signature']);
        });
    }
}
