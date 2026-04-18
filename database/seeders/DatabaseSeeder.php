<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
	use WithoutModelEvents;

	/**
	 * Seed the application's database.
	 */
	public function run()
	{
		$faker = Faker::create();
		foreach (range(1, 100) as $index) {
			\DB::table('pets')->insert([
				'name' => $faker->firstName,
				'type' => $faker->randomElement([
					'dog',
					'cat',
					'fish',
					'parrot',
					'rabbit'
				]),
				'breed' => $faker->word,
				'age' => rand(1, 15),
				'gender' => $faker->randomElement([
					'male',
					'female'
				]),
				'weight' => rand(1, 40),
				'vaccinated' => rand(0, 1),
				'status' => $faker->randomElement([
					'available',
					'adopted'
				]),
				'file_name' => null,
				'user_id' => rand(1, 5),
			]);
		}
	}
}
