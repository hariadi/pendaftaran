<?php
Route::group([
    'namespace'  => 'Participant',
    'middleware' => 'access.routeNeedsPermission:view-access-management',
], function() {

	Route::get('participants/{participant}/event/{event}/edit', 'ParticipantController@editEvent')
			->name('admin.participant.event.edit');

	Route::post('participant/ajaxattend', 'ParticipantController@ajaxAttend')
    	->name('participant.event.attend');

    Route::post('participant/ajaxadd', 'ParticipantController@ajaxAdd')
    	->name('participant.event.add');

	Route::resource('participant', 'ParticipantController');

});
