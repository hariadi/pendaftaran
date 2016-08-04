<?php

use Carbon\Carbon;
use App\Models\Event\Event;
use Illuminate\Database\Seeder;
use App\Models\Attendance\Attendance;
use App\Models\Participant\Participant;
use App\Models\EventParticipant\EventParticipant;

class EventParticipantPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('attendances')->truncate();

        $event = Event::whereDate('start_at', '=', Carbon::now()->toDateString())->first();

        if ($event) {

        	$participants = Participant::all();

	        foreach ($participants as $participant) {

	        	$attendance = new EventParticipant;
	        	$attendance->event_id = $event->id;
	        	$attendance->participant_id = $participant->id;
	        	$attendance->created_at = Carbon::now();
                $attendance->updated_at = Carbon::now();
                $attendance->save();

	        }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
