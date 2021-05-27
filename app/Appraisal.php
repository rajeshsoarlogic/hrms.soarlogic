<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Stamp;

class Appraisal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'description', 'stamp_id', 'pdf_name', 'digital_signature_id', 'template_id',
    ];

    public function stamp()
    {
        return $this->belongsTo(Stamp::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
