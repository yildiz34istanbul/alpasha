<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('countries')->delete();


        $Country_Name1['Country_Name'] = [
            'en'=> 'Palestine',
                'ar'=> 'فلسطين ',
                'tr'=> 'Filistin',
        ];
        $Country_Name2['Country_Name'] = [
            'en'=> 'Jordan',
                'ar'=> 'الاردن ',
                'tr'=> 'Ürdün',
        ];
        $Country_Name3['Country_Name'] = [
            'en'=> 'United Arab Emirates',
                'ar'=> 'الامارات  ',
                'tr'=> 'Birleşik Arap Emirlikleri',
        ];
        $Country_Name4['Country_Name'] = [
            'en'=> 'Saudi Arabia',
                'ar'=> 'السعودية',
                'tr'=> 'Suudi Arabistan',
        ];
        $Country_Name5['Country_Name'] = [
            'en'=> 'Kuwait',
            'ar'=> 'الكويت ',
            'tr'=> 'Kuveyt',
        ];
        $Country_Name6['Country_Name'] = [
            'en'=> 'Egypt',
                'ar'=> 'مصر ',
                'tr'=> 'Mısır',
        ];



        Country::create($Country_Name1);
        Country::create($Country_Name2);
        Country::create($Country_Name3);
        Country::create($Country_Name4);
        Country::create($Country_Name5);
        Country::create($Country_Name6);




    }
}
