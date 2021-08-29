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
                         'client_id'=>'88qbzpueTkGI66J9dKWd1g',
                         'client_secret'=>'3ZNpHxlheBOPr1NpqWB8fFTLX4BasWwM',
                         'callback_url'=>'https://localhost/show',
                         'environment'=>'local',
                         'current'=>true
                     ]);

         Setup::create([
                         'client_id'=>'88qbzpueTkGI66J9dKWd1g',
                         'client_secret'=>'3ZNpHxlheBOPr1NpqWB8fFTLX4BasWwM',
                         'callback_url'=>'https://localhost/show',
                         'environment'=>'production',
                         'current'=>false
                     ]);

    }
}
