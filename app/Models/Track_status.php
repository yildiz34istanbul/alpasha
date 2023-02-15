<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Track_status extends Model
{
    use HasTranslations;
    public $translatable = ['Status_Name'];
    protected $fillable =['Status_Name'];


    //protected $guarded =[];







    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }



}

