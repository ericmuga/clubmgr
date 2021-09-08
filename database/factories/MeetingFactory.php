<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\Setup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class MeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         /*
            "uuid",
                        "meeting_id",
                        "host_id",
                        "topic",
                        "type",
                        "start_time",
                        "duration",
                        "timezone",
                        "created_at",
                        "join_url",
                        "meeting_type"
         */


          $startDate=Carbon::now();
          $setup= Setup::where('current',true)->first();
          $setup->last_meeting_no++;
          $setup->save();

        return [
                    "uuid"=>$this->faker->uuid(),
                    // "uuid"=>$this->faker->uuid(),
                    // "meeting_id"=>'P'.strval($this->faker->numberBetween(1000,1000000000)),
                    "meeting_id"=>$setup->meeting_prefix.$setup->last_meeting_no,
                    "host_id"=>$this->faker->slug(),
                    "topic"=>$this->faker->word(),
                    "type"=>1,
                    "start_time"=>$this->faker->dateTimeInInterval($startDate= '+0 years', $interval = '-'.$this->faker->numberBetween(1,5).' days', $timezone = 'Africa/Nairobi'),
                    "duration"=>$this->faker->numberBetween(10,180),
                    "timezone"=>'Africa/Nairobi',
                   "created_at"=>$this->faker->dateTimeInInterval($startDate= '+0 years', $interval = '-'.$this->faker->numberBetween(1,5).' days', $timezone = 'Africa/Nairobi'),
                   "join_url"=>'',
                   "guest_speaker"=>$this->faker->title().' '.$this->faker->name(),
                    "meeting_type"=>"Physical"              ];
    }
}
