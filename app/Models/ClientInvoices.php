<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInvoices extends Model
{
    protected $fillable = [
        'tracking_id',
        'code_number',
        'invoice',
        'purchase_statement',
        'statement_packing',
        'shipping_documents',
        'user',
        'url'


    ];

    public $timestamps = true;


 


    public function client()
    {
        return $this->belongsTo(Client::class,'code_number','code_number');
    }


    public function TrackInvoices()
    {
        return $this->hasOne(Tracking::class,'tracking_id', 'id');
    }





}
