<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePerformance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'reviewer_name', 'reviewer_title', 'department_id', 'review_date', 'potential', 'work_quality', 'work_consistency', 'communication', 'independent_work', 'takes_initiative', 'group_work', 'productivity', 'creativity', 'honesty', 'integrity', 'coworker_relations', 'client_relations', 'technical_skills', 'dependability', 'punctuallity', 'attendance', 'previous_review_goals_achieved', 'goals_for_next_review', 'comment_and_approval', 'emp_sig', 'reviewer_sig'
    ];
}
