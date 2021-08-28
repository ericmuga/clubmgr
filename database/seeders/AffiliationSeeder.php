<?php

namespace Database\Seeders;
use App\Models\Affiliation;
use Illuminate\Database\Seeder;

class AffiliationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Affiliation::create(["code"=>"Rotarian","description"=>"Rotarian"]);
        Affiliation::create(["code"=>"Rotaractor","description"=>"Rotaractor"]);
        Affiliation::create(["code"=>"Guest","description"=>"Guest"]);
    }
}
