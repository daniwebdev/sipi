<?php
namespace Database\Seeds;

use App\People;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=1; $i <= 1000; $i++) {
            People::create([
                "uuid"           => Str::uuid(),
                "fullname"      => $faker->name,
                "birthday"       => $faker->date("Y-m-d", "2000-01-01"),
            ]);
        }
    }
}
