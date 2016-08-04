<?php

use App\Models\Event\Event;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factory;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('events')->truncate();

        $nextmonth = factory(Event::class, 'nextmonth', 2)->create();
        $nextweek = factory(Event::class, 'nextweek', 3)->create();
        $ongoings = factory(Event::class, 'ongoing', 2)->create();
        $pasts = factory(Event::class, 'past', 3)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
