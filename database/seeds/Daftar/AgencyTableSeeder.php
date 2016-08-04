<?php

use App\Models\Agency\Agency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('agencies')->truncate();


        // Get from JSON
        $jsonFile = Storage::get('agencies.json');

        $agencies = json_decode($jsonFile);

        foreach ($agencies as $parent) {
            $parentAgency = [
                'name' => $parent->nama,
                'short' => shorten($parent->nama),
            ];

            $agency = Agency::create($parentAgency);

            if (property_exists($parent, 'jabatan')) {
                foreach ($parent->jabatan as $jabatan) {
                    Agency::create([
                        'parent_id' => $agency->id,
                        'name' => $jabatan->nama,
                        'short' => shorten($jabatan->nama),
                    ]);
                }
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

