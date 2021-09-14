<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setup;
class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Setup::create([
                         'client_id'=>'teVC3mLMSZunq5lg5fk7Ww',
                         'client_secret'=>'6bkmRWdK5Att6lVkUlOyCB4H5wds5mt6',
                         'callback_url'=>'https://localhost/show',
                         'environment'=>'local',
                         'meeting_prefix'=>"P",
                         'last_meeting_no'=>10000,
                         'current'=>true
                     ]);

          Setup::create([
                         'client_id'=>'teVC3mLMSZunq5lg5fk7Ww',
                         'client_secret'=>'6bkmRWdK5Att6lVkUlOyCB4H5wds5mt6',
                         'callback_url'=>'https://club.minorharmony.com/show',
                         'environment'=>'production',
                         'meeting_prefix'=>"P",
                         'last_meeting_no'=>10000,
                         'current'=>false
                     ]);


         Setup::create([
                         'client_id'=>'88qbzpueTkGI66J9dKWd1g',
                         'client_secret'=>'3ZNpHxlheBOPr1NpqWB8fFTLX4BasWwM',
                         'callback_url'=>'https://club.minorharmony.com/show',
                         'environment'=>'production',
                         'meeting_prefix'=>"P",
                         'last_meeting_no'=>10000,
                         'current'=>false
                     ]);

    }
}
