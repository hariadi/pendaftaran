<?php
Route::group([
    'namespace'  => 'Report',
    'middleware' => 'access.routeNeedsPermission:view-access-management',
], function() {

	Route::get('report/event/{event}/cert', 'ReportController@cert')->name('admin.report.cert');
	Route::get('report/event/{event}', 'ReportController@event')->name('admin.report.event');
	Route::get('report/event/{event}/participants', 'ReportController@participants')->name('admin.report.participants');
	Route::get('report/event/{event}/agencies', 'ReportController@agencies')->name('admin.report.agencies');
	Route::resource('report', 'ReportController');

});
