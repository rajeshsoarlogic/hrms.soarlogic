<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'skypeid', 'email', 'mobile_num', 'exp_in_yrs', 'resume', 'skills',
    ];
}
