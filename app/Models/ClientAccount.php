<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'Debit',
        'credit',
        'description',
        'type'
    ];


    public function client()
    {
       return $this->hasMany(Client::class,'id','client_id');
   }





}
