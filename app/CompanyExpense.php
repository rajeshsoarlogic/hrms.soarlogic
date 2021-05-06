<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class CompanyExpense extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'item', 'purchase_from', 'date_of_purchase', 'amount',
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
