<?php

namespace Database\Factories;

use App\Models\Registrant;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
class RegistrantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Registrant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    /*
                  'meeting_id',
                  'email',
                  'first_name',
                  'last_name',
                  'category',
                  'club_name',
                  'invited_by',
                  'classification',
                  'create_time'
    */
    public function definition()
    {
        $startDate=Carbon::now();
        //$meeting=Meeting::factory()->create();
        //dd($meeting->meeting_id);
        return [ 'meeting_id'=>Meeting::factory(),
                'email'=>$this->faker->unique()->safeEmail,
                 'first_name'=>$this->faker->name(),
                 'last_name'=>$this->faker->name(),
                 'category' => $this->faker->randomElement(['Rotarian','Rotaractor','Guest']),
                 'club_name' => $this->faker->randomElement(['RC_Langata', 'RC_Muthaiga','RC_Mombasa','RC_Westlands','']),
                 'classification' => $this->faker->randomElement(['inductee','member']),
                 "create_time"=>$this->faker->dateTimeInInterval($startDate= '+0 years', $interval = '-'.$this->faker->numberBetween(1,5).' days', $timezone = 'Africa/Nairobi'),
                 "invited_by"=>$this->faker->name()
                
              ];
    }
}
