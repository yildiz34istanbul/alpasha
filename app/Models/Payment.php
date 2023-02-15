<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'currency',
        'financial_item',
        'date',
        'note',

    ];


    public function client()
    {
       return $this->hasMany(Client::class,'id','client_id');
   }

}
