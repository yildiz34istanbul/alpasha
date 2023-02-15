<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tracking;
use App\Models\TrackingReport;

class Country extends Model
{
    use HasTranslations;
    use SoftDeletes;
    public $translatable = ['Country_Name'];
    protected $fillable =['Country_Name'];
    public $timestamps = true;




    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }


    public function track_conutry(){

        return $this->hasMany(Tracking::class,'country_id','id');

    }





}
