<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('clients')->delete();
        $clients = new Client();
        $clients->name = 'clinet';
        $clients->email = 'client@gmail.com';
        $clients->password = Hash::make('12345678');
        $clients->locale = 'ar';
        $clients->code_number = '123';
        $clients->status = '1';
        $clients->phone = '123456789';
        $clients->country = 'istanbul';
        $clients->city = 'istanbul';
        $clients->address = 'istanbul';

        $clients->save();




    }
}
