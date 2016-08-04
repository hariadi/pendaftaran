<?php
Route::group([
    'namespace'  => 'Event',
    'middleware' => 'access.routeNeedsPermission:view-access-management',
], function() {

	Route::get('event/modal', 'EventController@modal')->name('admin.event.modal');
	Route::resource('event', 'EventController');

});
