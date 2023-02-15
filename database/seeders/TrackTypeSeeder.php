<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrackingType;
use Illuminate\Support\Facades\DB;

class TrackTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('tracking_types')->delete();


        $tracking_type_name1['tracking_type_name'] = [
            'en'=> 'tracking collecting',
                'ar'=> 'تجميع ',
                'tr'=> 'Toplama',
        ];
        $tracking_type_name2['tracking_type_name'] = [
            'en'=> 'Export',
                'ar'=> 'تصدير ',
                'tr'=> 'İhracat',
        ];
        $tracking_type_name3['tracking_type_name'] = [
            'en'=> 'express',
                'ar'=> 'اكسبريس  ',
                'tr'=> 'ekspres',
        ];
        $tracking_type_name4['tracking_type_name'] = [
            'en'=> 'Door to Door',
                'ar'=> 'دور تو دور ',
                'tr'=> 'kapı kapıya',
        ];




        TrackingType::create($tracking_type_name1);
        TrackingType::create($tracking_type_name2);
        TrackingType::create($tracking_type_name3);
        TrackingType::create($tracking_type_name4);






    }
}
