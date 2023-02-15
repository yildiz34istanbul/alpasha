<?php

namespace Database\Seeders;
use App\Models\Track_status;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrackStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('track_statuses')->delete();


        $track_status1['Status_Name'] = [
            'en'=> 'Open The Purchase File',
                'ar'=> 'فتح ملف الشراء ',
                'tr'=> 'Satın Alma Dosyasını Aç',
        ];
        $track_status2['Status_Name'] = [
            'en'=> 'Buying finished',
                'ar'=> 'إنتهاء الشراء ',
                'tr'=> 'Satın alma tamamlandı',
        ];
        $track_status3['Status_Name'] = [
            'en'=> 'Collecting merchandise from the market',
                'ar'=> 'جمع البضائع من الأسواق ',
                'tr'=> 'Pazardan mal toplamak',
        ];
        $track_status4['Status_Name'] = [
            'en'=> 'Goods leaving the warehouse',
                'ar'=> 'خروج البضائع من المستودع',
                'tr'=> 'Depodan çıkan mallar',
        ];
        $track_status5['Status_Name'] = [
            'en'=> 'Under customs clearance in your country',
            'ar'=> 'قيد التخليص الجمركي في بلدكم ',
            'tr'=> 'Ülkenizdeki gümrük işlemleri kapsamında',
        ];
        $track_status6['Status_Name'] = [
            'en'=> 'On the way to you',
                'ar'=> 'في الطريق إليكم ',
                'tr'=> 'kargo yolda',
        ];
        $track_status7['Status_Name'] = [
            'en'=> 'sent delivered handed',
                'ar'=> 'تم التسليم ',
                'tr'=> 'elden teslim gönderildi',
        ];


        Track_status::create($track_status1);
        Track_status::create($track_status2);
        Track_status::create($track_status3);
        Track_status::create($track_status4);
        Track_status::create($track_status5);
        Track_status::create($track_status6);
        Track_status::create($track_status7);





    }



}
