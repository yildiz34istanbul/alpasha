<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TrackingReport extends Model
{
    protected $fillable = [
        'tracking_id',
        'tracking_number',
        'code_number',
        'tacking_status_id',
        'country_id',
        'type_tracking_id',
        'user',


    ];

    public $timestamps = true;



    public function trackingId()
    {
        return $this->hasOne(Tracking::class,'id', 'tracking_id');
    }

    public function user()
    {
       return $this->hasOne(User::class,'id','user_id');
   }


   public function status()
   {
       return $this->hasOne(Track_status::class,'id', 'tacking_status_id');
   }



   public function Country()
   {
      // return $this->hasOne(Country::class,'id', 'country_id');
       return $this->belongsTo(Country::class,'country_id', 'id');
   }


   public function tracktype()
   {
       return $this->hasOne(TrackingType::class,'id', 'type_tracking_id');
   }








}
