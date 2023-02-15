<?php

namespace App\Imports;

use App\Models\ClientAccount;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;

class ClientAccountImport implements ToModel ,WithHeadingRow
{


    private $clients;

    public function  __construct(){


    }


    public function model(array $row)
    {
       // $client = $this->clients->where('code_number',$row['code_number'])->first();
        return new ClientAccount([

            "client_id"  => $row['code_number'],
            "credit"=>$row['invoice_value'],
            "Debit"=> 0.00,
           "created_at"=>Carbon::now()


        ]);
    }
}
