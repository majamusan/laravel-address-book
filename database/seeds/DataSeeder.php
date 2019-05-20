<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();

		echo "creating contacts.\r\n";
		for ($i=0; $i < 600; $i++) { 
	        $contactId = DB::table('contacts')->insertGetId(['first' => $faker->firstName, 'last' => $faker->lastName, ]);
	        DB::table('details')->insertGetId(['type' => 'email', 'data' => $faker->email, 'contacts_id'=>$contactId ]);
	        DB::table('details')->insertGetId(['type' => 'email', 'data' => $faker->email, 'contacts_id'=>$contactId ]);
	        DB::table('details')->insertGetId(['type' => 'phone', 'data' => $faker->phoneNumber, 'contacts_id'=>$contactId ]);
	        echo "$i ";
		}
        echo "\r\n";
    }
}
