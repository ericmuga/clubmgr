<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use App\Models\Member;
use App\Models\Meeting;
use App\Models\Registrant;
use App\Models\Type;
use App\Models\Affiliation;
use App\Models\Setup;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
             
 

        $account = Account::create(['name' => 'Rotary Club Langata']);

        User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'owner' => true,
        ]);

        User::factory(5)->create(['account_id' => $account->id]);

        $organizations = Organization::factory(100)
            ->create(['account_id' => $account->id]);

        Contact::factory(100)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });

             $this->call([
                            TypeSeeder::class,
                            AffiliationSeeder::class,
                            SetupSeeder::class, 
                        ]);
              
        Member::factory(120)->create(); 
        
       
        $members=Member::all();
        foreach ($members as $member ) 
        {
             DB::table('affiliation_member')->insert(["affiliation_id"=>$member->affiliation_id,"member_id"=>$member->id]);
             DB::table('member_type')->insert(['type_id'=>$member->type_id,"member_id"=>$member->id]);
         } 

         Meeting::factory(12)->create();
         $meetings= Meeting::where('meeting_type',"Physical")->get();

         foreach($meetings as $meeting )
         {
            Registrant::factory(20)->create(['meeting_id'=>$meeting->id]);
         }

         // $meetings= Meeting::where('meeting_type',"Physical")->get();

         // foreach($meetings as $meeting )
         // {
         //    Registrant::factory(120)->create(['meeting_id'=>$meeting->meeting_id]);
         // }


    }


}
