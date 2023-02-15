<?php

namespace App\Imports;

use App\Models\Payment;
use App\Models\Client;
use App\Models\ClientAccount;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PaymentsImport implements ToModel , WithHeadingRow
{

    private $clients;

    public function  __construct(){

       $this->clients = Client::select('id','code_number')->get();
    }

    public function model(array $row)
    {
        $client = $this->clients->where('code_number',$row['code_number'])->first();

        return new Payment([

            "client_id"  => $client->id ?? Null,
            "amount" => $row['amount'],
            "currency"=> $row['currency'],
            "financial_item"=> $row['financial_item'],
            "date"=> $row['date'],
            "note"=> $row['note'],



        ]);

      
    }
}
