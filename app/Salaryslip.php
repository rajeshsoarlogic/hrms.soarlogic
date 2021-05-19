<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Salaryslip extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'department', 'month_year', 'pan', 'role_id', 'basic', 'da', 'hra', 'conveyance_allow', 'education_allow', 'medical_allow', 'internet_allow', 'special_allow', 'p_fund', 'taxes', 'pdf_name',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
