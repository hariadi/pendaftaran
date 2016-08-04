<?php

use Carbon\Carbon;
use App\Models\Event\Event;
use App\Models\Access\User\User;
use App\Models\Category\Category;
use App\Models\Participant\Participant;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Event::class, function (Faker\Generator $faker) {

    $events = [
        'Klinik Psikologi \'Kenali Diri Bina Identiti\'',
        'Kursus Motivasi: "Spirit Booster"',
        'Kursus Creativity Begins With Me',
        'Seminar Pengurusan Kewangan Peribadi',
        'Bengkel Pengurusan Tatatertib',
        'Kursus Kecergasan Dan Gaya Hidup Sihat: Enjoy, Health & Fun',
        'Perhimpunan Bulanan Anjuran BPMS',
    ];

    return [
    	'token' => md5(uniqid(mt_rand(), true)),
        'name' => $faker->randomElement($events),
        'description' => $faker->sentences(3, true),
        'attendant' => 0,
        'user_id' => 1,
        'location' => $faker->address,
        'options' => [
        	'share' => [
        		'facebook' => $faker->randomElement([true, false]),
        		'twitter' => $faker->randomElement([true, false]),
        		'gplus' => $faker->randomElement([true, false]),
        	],
        ],
    ];
});

$factory->defineAs(Event::class, 'ongoing', function ($faker) use ($factory) {

    $event = $factory->raw(Event::class);

    $start_at = Carbon::createFromTime(8);
	$end_at = $start_at->copy()->addDays($faker->randomElement([1, 2, 3]))->addHours(8);

    return array_merge($event, [
    	'start_at' => $start_at,
        'end_at' => $end_at,
    ]);
});

$factory->defineAs(Event::class, 'future', function ($faker) use ($factory) {

    $event = $factory->raw(Event::class);

    $start_at = Carbon::createFromTime(8)->addWeek();
	$end_at = $start_at->copy()->addHours(8);

    return array_merge($event, [
    	'start_at' => $start_at,
        'end_at' => $end_at,
    ]);
});

$factory->defineAs(Event::class, 'nextweek', function ($faker) use ($factory) {

    $event = $factory->raw(Event::class);

    $start_at = Carbon::createFromTime(8)->addWeek();
	$end_at = $start_at->copy()->addDays($faker->randomElement([1, 2, 3]))->addHours(8);

    return array_merge($event, [
    	'start_at' => $start_at,
        'end_at' => $end_at,
    ]);
});

$factory->defineAs(Event::class, 'nextmonth', function ($faker) use ($factory) {

    $event = $factory->raw(Event::class);

    $start_at = Carbon::createFromTime(8)->addMonth();
	$end_at = $start_at->copy()->addDays($faker->randomElement([1, 2, 3]))->addHours(8);

    return array_merge($event, [
    	'start_at' => $start_at,
        'end_at' => $end_at,
    ]);
});

$factory->defineAs(Event::class, 'past', function ($faker) use ($factory) {

    $event = $factory->raw(Event::class);

    $start_at = Carbon::createFromTime(8)->subWeek();
	$end_at = $start_at->copy()->addHours(8);

    return array_merge($event, [
    	'start_at' => $start_at,
        'end_at' => $end_at,
    ]);
});

$factory->define(Participant::class, function (Faker\Generator $faker) {

    $ic = '';

    for ($i=0; $i < 12; $i++) {
        // get a random digit, but always a new one, to avoid duplicates
        $ic .= $faker->randomDigit;
    }

    return [
        'name' => $faker->name,
        'ic' => $ic,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'job_title' => strtoupper($faker->word),
        'grade' => strtoupper($faker->randomLetter) . $faker->randomNumber(2),
    ];
});

$factory->define(Category::class, function (Faker\Generator $faker) {

    return [
        'name' => ucfirst($faker->word),
        'description' => $faker->sentences(3, true),
    ];
});
