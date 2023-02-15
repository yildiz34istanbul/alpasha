<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TrackingType extends Model
{



    use HasTranslations;
    public $translatable = ['tracking_type_name'];
    protected $fillable =['tracking_type_name'];




    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }



}
