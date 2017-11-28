<?php

use \App\Student;
use \Vendor\zaninotto\faker\src\Faker\Factory;
use Illuminate\Database\Seeder;

class students_table_seeder extends Seeder
{

    protected $quantity = 30;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();
        for ($i=0; $i < $this->quantity; $i++) {
          // 'course', 'name', 'surname', 'age', 'school'
          Student::create([
            'course' => $faker->numberBetween(1, 6),
            'name' => $faker->name(),
            'surname' => $faker->firstName(),
            'age' => $faker->numberBetween(14, 18),
            'school' => $faker->stateAbbr()
          ]);
        }
    }
}
