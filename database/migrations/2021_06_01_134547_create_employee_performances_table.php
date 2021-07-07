<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_performances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('reviewer_name')->nullable();
            $table->string('reviewer_title')->nullable();
            $table->integer('department_id')->nullable();
            $table->date('review_date');
            $table->integer('potential')->nullable();
            $table->integer('work_quality')->nullable();
            $table->integer('work_consistency')->nullable();
            $table->integer('communication')->nullable();
            $table->integer('independent_work')->nullable();
            $table->integer('takes_initiative')->nullable();
            $table->integer('group_work')->nullable();
            $table->integer('productivity')->nullable();
            $table->integer('creativity')->nullable();
            $table->integer('honesty')->nullable();
            $table->integer('integrity')->nullable();
            $table->integer('coworker_relations')->nullable();
            $table->integer('client_relations')->nullable();
            $table->integer('technical_skills')->nullable();
            $table->integer('dependability')->nullable();
            $table->integer('punctuallity')->nullable();
            $table->integer('attendance')->nullable();
            $table->integer('previous_review_goals_achieved')->nullable();
            $table->text('goals_for_next_review')->nullable();
            $table->text('comment_and_approval')->nullable();
            $table->string('emp_sig')->nullable();
            $table->string('reviewer_sig')->nullable();
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
        Schema::dropIfExists('employee_performances');
    }
}
