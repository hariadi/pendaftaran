<?php

use Illuminate\Database\Seeder;

class DaftarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call(DaftarPermissionTableSeeder::class);
        $this->call(AgencyTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(ParticipantsTableSeeder::class);
        $this->call(EventParticipantPivotSeeder::class);
        $this->call(AttendancesTableSeeder::class);
        $this->call(PermissionDaftarDependencyTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
