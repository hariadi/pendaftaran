<?php
Route::group([
    'namespace'  => 'Agency',
    'middleware' => 'access.routeNeedsPermission:view-access-management',
], function() {

	Route::resource('agencies', 'AgencyController');

});
