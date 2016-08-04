<?php

use Carbon\Carbon;
use App\Models\Event\Event;
use Illuminate\Database\Seeder;
use App\Models\Attendance\Attendance;
use App\Models\Participant\Participant;
use App\Models\EventParticipant\EventParticipant;

class AttendancesTableSeeder extends Seeder
{
	protected $event;
	protected $attends = [];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('attendances')->truncate();

        // Get event
        $this->event = Event::find(1);

        // Get id for event participant accosiate table
        $this->attends = EventParticipant::pluck('id')->toArray();

        // 10 of them attend all days
        foreach ([1, 2, 5, 6, 8, 11, 14] as $id) {
    		foreach ($this->event->getDateRanges() as $date) {
    			$attendance = new Attendance;
	        	$attendance->event_participant_id = $id;
	        	$attendance->created_at = $date;
	        	$attendance->save();
    		}
        }

        // 5 of them only attend day one and day two
        foreach ([3, 7, 10, 12] as $id) {
    		foreach ($this->event->getDateRanges() as $key => $date) {
    			if ($key == 2) continue;
    			$attendance = new Attendance;
	        	$attendance->event_participant_id = $id;
	        	$attendance->created_at = $date;
	        	$attendance->save();
    		}
        }

        // 2 of them only attend day one and day three
        foreach ([15, 20] as $id) {
    		foreach ($this->event->getDateRanges() as $key => $date) {
    			if ($key == 1) continue;
    			$attendance = new Attendance;
	        	$attendance->event_participant_id = $id;
	        	$attendance->created_at = $date;
	        	$attendance->save();
    		}
        }

        // 3 of them only attend one day
        foreach ([4, 17, 21] as $id) {
    		foreach ($this->event->getDateRanges() as $key => $date) {
    			if ($key == 0) {
    				$attendance = new Attendance;
		        	$attendance->event_participant_id = $id;
		        	$attendance->created_at = $date;
		        	$attendance->save();
    			}
    		}
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
