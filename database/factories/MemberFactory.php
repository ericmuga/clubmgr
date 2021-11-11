<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [ 
                 'member_id'=>'RCL'.$this->faker->numberBetween(10000,1000000),
                 'name'=>$this->faker->name(),
                 'email'=>$this->faker->unique()->safeEmail,
                 'phone'=>$this->faker->phoneNumber(),
                 'affiliation_id'=>$this->faker->numberBetween(1,3),
                 'type_id'=>$this->faker->numberBetween(1,2),
                 'sector'=>$this->faker->word()
              ];
    }

}
