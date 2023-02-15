<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrackMethod;
use Illuminate\Support\Facades\DB;

class TrackMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('track_methods')->delete();


        $track_Method_name1['method_name'] = [
            'en'=> 'Air freight',
                'ar'=> 'شحن جوي',
                'tr'=> 'Hava taşımacılığı',
        ];
        $track_Method_name2['method_name'] = [
            'en'=> 'Sea freight',
                'ar'=> 'شحن بحري',
                'tr'=> 'Deniz taşımacılığı',
        ];
        $track_Method_name3['method_name'] = [
            'en'=> 'land shipping',
                'ar'=> 'شحن بري',
                'tr'=> 'kara nakliyesi',
        ];





        TrackMethod::create($track_Method_name1);
        TrackMethod::create($track_Method_name2);
        TrackMethod::create($track_Method_name3);
    }
}
