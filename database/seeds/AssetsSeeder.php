<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;

class AssetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('assets')->insert([
                'user_id' => Auth::user()->id,
	            'type' => $faker->type,
	            'investment_type' => $faker->investment_type,
	            'company_name' => $faker->company_name,
	            'comapnay_phone' => $faker->comapnay_phone,
	            'company_email' => $faker->company_email
	        ]);
	    }
    }
}
