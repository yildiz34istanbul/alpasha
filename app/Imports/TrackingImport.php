<?php

namespace App\Imports;

use App\Models\Tracking;
use App\Models\Payment;
use App\Models\Client;
use App\Models\ClientAccount;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Auth;
use Illuminate\Support\Carbon;

class TrackingImport implements ToModel,WithHeadingRow,WithValidation
{



    public function  __construct(){


     }

    public function model(array $row)
    {

        return new Tracking([

            "tracking_number"=>$row['tracking_number'],
            "code_number"=> $row['code_number'],
            "tacking_status_id"=> $row['tacking_status_id'],
            "country_id"=>$row['country_id'],
            "type_tracking_id"=>$row['type_tracking_id'],
            "track_method_id"=>$row['track_method_id'],
            "tracking_date"=>$row['tracking_date'],
            "cartons_number"=>$row['cartons_number'],
            "pieces_number"=>$row['pieces_number'],
            "invoice_value"=>$row['invoice_value'],
            "arrival_time"=>$row['arrival_time'],
            "user_id"=> Auth::user()->id,
           "created_at"=>Carbon::now()
        ]);


       

    }


    public function rules(): array
    {
        return [

            'tracking_number' => 'unique:trackings,tracking_number',


        ];
    }
}
