<?php

namespace Database\Factories;

use App\Models\Participant;
use App\Models\Meeting;
use App\Models\Registrant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Participant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         /*
            $table->id();
            $table->string('meeting_id');
            $table->string('participant_id');
            $table->string('user_id');
            $table->string('name');
            $table->strin('user_email');
            $table->timestampsTz('join_time');
            $table->timestampsTz('leave_time');
            $table->integer('duration');
            $table->string('registrant_id');
            $table->timestamps();
        });
         */


        return [
                 'meeting_id'=>Meeting::factory(),
                 'participant_id'=>$this->faker->uuid(),
                 'user_id'=>$this->faker->uuid(),
                 'user_email'=>$this->faker->safeEmail,
                 'name'=>$this->faker->name(),
                 'join_time'=>$this->faker->dateTimeInInterval($startDate= '+0 years', $interval = '-'.$this->faker->numberBetween(1,5).' days', $timezone = 'Africa/Nairobi'),
                 'leave_time'=>$this->faker->dateTimeInInterval($startDate= '+0 years', $interval = '-'.$this->faker->numberBetween(1,5).' days', $timezone = 'Africa/Nairobi'),
                'duration'=>$this->faker->numberBetween(1,120),
                'registrant_id'=>Registrant::factory()
                
               ];
    }
}
