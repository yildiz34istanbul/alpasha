<?php

namespace App\Imports;

use App\Models\TrackingReport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;
use Illuminate\Support\Carbon;

class TrackingReportImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TrackingReport([
            "tracking_id"=>'1',
            "tracking_number"=>$row['tracking_number'],
            "tacking_status_id"=> $row['tacking_status_id'],
            "user"=> Auth::user()->name,
           "created_at"=>Carbon::now()
        ]);
    }
}
