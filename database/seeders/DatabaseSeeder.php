<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use App\Models\Member;
use App\Models\Meeting;
use App\Models\Registrant;
use App\Models\Participant;
use App\Models\Type;
use App\Models\Affiliation;
use App\Models\Setup;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

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
      DB::table('members')->where('affiliation_id',3)->update(['type_id'=>2]);
      DB::table('members')->where('affiliation_id','<>',3)->update(['type_id'=>1]);
       
        $members=Member::all();
        foreach ($members as $member ) 
        {
             DB::table('affiliation_member')->insert(["affiliation_id"=>$member->affiliation_id,"member_id"=>$member->id]);
             DB::table('member_type')->insert(['type_id'=>$member->type_id,"member_id"=>$member->id]);
         } 

        // Meeting::factory(12)->create();
         $meetings= Meeting::where('meeting_type',2)->get();



         foreach($meetings as $meeting )
         {
           
                 $faker = \Faker\Factory::create();
                

                 for ($i=1; $i <121 ; $i++) 
                 { 
                    //create registrants for the meeting
   
                            $email=$faker->unique()->safeEmail;

                        $st=$meeting->start_time;
                           //Carbon::create(2012, 1, 1, 0, 0, 0, 'America/Vancouver'

                            
                           
                            $creatTime=$st->sub($faker->numberBetween(1,3),'days');
                            $joinTime=$st->add($faker->numberBetween(-15,50),'minutes');
                            $duration=$faker->numberBetween(1,120);
                            $leaveTime=$joinTime->add($duration,'minutes');

                            if (!Registrant::where('email',$email)->exists()){

                          $registrant= Registrant::firstOrCreate([
                                  'meeting_id'=>$meeting->meeting_id,
                                  'email'=>$email,
                                  'first_name'=>$faker->name(),
                                  'last_name'=>$faker->name(),
                                  'category' => $faker->randomElement(['Rotarian','Rotaractor','Guest']),
                                   'club_name' => $faker->randomElement(['RC_Langata', 'RC_Muthaiga','RC_Mombasa','RC_Westlands','']),
                                 'classification' => $faker->randomElement(['inductee','member']),
                                 // "create_time"=>$faker->dateTimeInInterval($startDate= '+0 years', $interval = '-'.$faker->numberBetween(1,5).' days', $timezone = 'Africa/Nairobi'),
                                 "create_time"=>$creatTime,
                                 "invited_by"=>$faker->name()
                            ]); 
                          }      
                     //create participants for the meeting

                            DB::table('participants')->insert([
                             'meeting_id'=>$meeting->meeting_id,
                             'participant_id'=>$faker->uuid(),
                             'user_id'=>$faker->uuid(),
                             'user_email'=>$faker->safeEmail,
                             'name'=>$faker->name(),
                             // 'join_time'=>$faker->dateTimeInInterval($startDate= '+0 years', $interval = '-'.$faker->numberBetween(1,5).' days', $timezone = 'Africa/Nairobi'),
                             'join_time'=>$joinTime,
                             // 'leave_time'=>$faker->dateTimeInInterval($startDate= '+0 years', $interval = '-'.$faker->numberBetween(1,5).' days', $timezone = 'Africa/Nairobi'),
                             'leave_time'=>$leaveTime,
                            'duration'=>$duration,
                            'registrant_id'=>$registrant->id

                            
                            ]);


                 }

            //
           // Participant::factory(120)->create(['meeting_id'=>$meeting->meeting_id]);
         }
             //meeting registration time = one day before meeting
        foreach (Participant::all() as $participant) 
        {
           $meeting=Meeting::where('meeting_id',$participant->meeting_id)->first();
           $participant->join_time=$meeting->start_time->add($faker->numberBetween(-15,10),'minutes');
           $participant->save();




           $participant->leave_time=$participant->join_time->add($participant->duration,'minutes');

           $participant->save();

           

        }

    }


}
