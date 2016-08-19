<?php

/**
 * Frontend Controllers
 */

/**
 * Event Front
 */
Route::group(['namespace' => 'Event'], function() {
	Route::get('/', 'EventController@index')->name('frontend.index');

	Route::resource('event', 'EventController');

	Route::get('e/{token}', 'EventController@addParticipantsByToken')->name('event.add.participants.token');
	Route::post('e/{token}', 'EventController@storeParticipantsByToken')->name('event.store.participants.token');

	Route::get('event/{event}/participant', 'EventController@addParticipant')->name('event.add.participant');
	Route::post('event/{event}/participant', 'EventController@storeParticipant')->name('event.store.participant');

	Route::get('event/{event}/participants', 'EventController@addParticipants')->name('event.add.participants');
	Route::post('event/{event}/participants', 'EventController@storeParticipants')->name('event.store.participants');
});

Route::group(['namespace' => 'Participant'], function() {

	Route::get('participants/{participant}/edit', 'ParticipantController@edit')
    	->name('participant.edit');
    Route::post('participants/ajaxattend', 'ParticipantController@ajaxAttend')
    	->name('participant.event.attend');

    /**
     * These routes require the user to be logged in
     */
    Route::group(['middleware' => 'auth'], function () {

    	Route::resource('participant', 'ParticipantController');

		Route::get('participant/{participant}/event/{event}/edit', 'ParticipantController@editEvent')
			->name('participant.event.edit');

    });
});


Route::get('macros', 'FrontendController@macros')->name('frontend.macros');


/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');
    });
});
