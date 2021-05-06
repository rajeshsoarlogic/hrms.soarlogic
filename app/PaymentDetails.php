<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Invoice;

class PaymentDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'invoice_id', 'upload_file', 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
