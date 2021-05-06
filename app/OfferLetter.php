<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Stamp;

class OfferLetter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'other_emails', 'description', 'stamp_id', 'pdf_name', 'token', 'accepted', 'digital_signature_id', 'emp_signature', 'template_id',
    ];

    public function stamp()
    {
        return $this->belongsTo(Stamp::class);
    }
}
