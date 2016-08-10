<?php
Route::group([
    'namespace'  => 'Event',
    'middleware' => 'access.routeNeedsPermission:view-access-management',
], function() {

	Route::get('event/modal', 'EventController@modal')->name('admin.event.modal');

	Route::resource('event', 'EventController');

	Route::delete('event/{event}/participant/{participant}/destroy', 'EventController@destroyParticipant')->name('admin.event.destroyParticipant');

});
