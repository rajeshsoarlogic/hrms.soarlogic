<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'bank_details', 'pan', 'gst_num', 'soft_tech_num', 'other_details', 'moa_aoa', 'mca_certificate',
    ];
}
