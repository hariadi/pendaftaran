<?php

use Illuminate\Database\Seeder;
use App\Models\Participant\Participant;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('participants')->truncate();

        // Create two participants for each agencies
        foreach ([
        	1, 9, 14, 15, 23, 30,
        	44, 49, 61, 74, 75,
        ] as $agency) {
        	factory(Participant::class, 2)->create([
				'agency_id' => $agency,
			]);
        }

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
