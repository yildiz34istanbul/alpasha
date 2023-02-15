<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;




class Tracking extends Model
{

    use SoftDeletes;


    protected $fillable = [
        'user_id',
        'tracking_number',
        'code_number',
        'tacking_status_id',
        'country_id',
        'type_tracking_id',
        'track_method_id',
        'cartons_number',
        'invoice_value',
        'tracking_date',
        'pieces_number',
        'arrival_time',
        'notes',
        'weight',



    ];
    public $timestamps = true;

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

   public function trackmethod()
   {
       return $this->hasOne(TrackMethod::class,'id', 'track_method_id');
   }

   public function trackreport()
   {
       return $this->belongsTo(TrackingReport::class,'tracking_id', 'id');
   }


   public function client()
   {
       return $this->belongsTo(Client::class,'code_number','code_number');
   }


   public function trackInvoices()
   {
       return $this->belongsTo(ClientInvoices::class,'tracking_id', 'id');
   }





}
