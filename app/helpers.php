<?php

use Carbon\Carbon;

/**
 * Global helpers file with misc functions
 *
 */

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('carbon')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function carbon($date)
    {
        return Carbon::parse($date);
    }
}

if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function
     */
    function access()
    {
        return app('access');
    }
}

if (! function_exists('javascript')) {
    /**
     * Access the javascript helper
     */
    function javascript()
    {
        return app('JavaScript');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('getFallbackLocale')) {
    /**
     * Get the fallback locale
     *
     * @return \Illuminate\Foundation\Application|mixed
     */
    function getFallbackLocale()
    {
        return config('app.fallback_locale');
    }
}

if (! function_exists('getLanguageBlock')) {

    /**
     * Get the language block with a fallback
     *
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getLanguageBlock($view, $data = [])
    {
        $components = explode("lang", $view);
        $current  = $components[0]."lang.".app()->getLocale().".".$components[1];
        $fallback  = $components[0]."lang.".getFallbackLocale().".".$components[1];

        if (view()->exists($current)) {
            return view($current, $data);
        } else {
            return view($fallback, $data);
        }
    }
}

if (! function_exists('options')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function options($event, $key = null)
    {
        $options = app('App\Models\Event\Options');
        return $key ? $options->get($key) : $options;
    }
}

if (! function_exists('shorten')) {

    /**
     * Get the shorten version of name
     *
     * @param $str
     * @return string
     */
    function shorten($str)
    {
        // If we have only one character, just return it
        if (str_word_count($str) <= 1) {
            return strtoupper($str);
        }

        // If we have text inside (parenthesis), we will use it
        if (preg_match('#\((.*?)\)#', $str, $match)) {
            return $match[1];
        }

        return implode('', array_map(function($word) {
            return preg_match('/[A-Z]/', $word[0]) ? $word[0] : '';
        }, array_filter(preg_split("/[\s,&,_,-,\(,\)]+/", preg_replace("/\([^)]+\)/","",$str)))));
    }
}

if (! function_exists('isAttend')) {

    /**
     * Get the isAttend version of name
     *
     * @param array $dates
     * @return Carbon\Carbon $date
     */
    function isAttend($dates, $date = null)
    {
        if (empty($dates)) {
            return false;
        }

        $date = $date ?: Carbon::now();

        foreach ($dates as $attend) {
            if ($date->between($attend->startOfDay(), $attend->copy()->endOfDay())) {
                return true;
            }
        }

        return false;
    }
}

if (! function_exists('attend')) {

    /**
     * Get the attend version of name
     *
     * @param array $dates
     * @return Carbon\Carbon $date
     */
    function attend($event, $dates)
    {
        if (empty($dates)) {
            return false;
        }

        $count = count($dates);
        $total = count($event->getDateRanges());

        if ($count == $total) {
            return $event->start_at->formatLocalized('%d %B %Y') . ' hingga ' . $event->end_at->formatLocalized('%d %B %Y');
        }

        $newDates = array_map(function($date) {
            return $date->formatLocalized('%d %B %Y');
        }, $dates);

        return join(' dan ', array_filter(array_merge(array(join(', ', array_slice($newDates, 0, -1))), array_slice($newDates, -1)), 'strlen'));
    }
}

if (! function_exists('bgClass')) {
    /**
     * Helper to set active states for menu
     *
     * @return string
     */
    function bgClass($num = 0, $progress = true)
    {
        $bgClass = '';

        if (!is_numeric($num) || $num == 0) {
            return $progress ? 'bg-red' : 'danger';
        }

        $num = round($num);
        switch ($num) {

            case ($num >= 75):
                $bgClass = $progress ? 'bg-green' : 'success';
                break;

            case ($num >= 50 && $num <= 74.99):
                $bgClass = $progress ? 'bg-light-blue' : 'primary';
                break;

            case ($num >= 25 && $num <= 49.99):
                $bgClass = $progress ? 'bg-yellow' : 'warning';
                break;

            case ($num <= 24.99):
                $bgClass = $progress ? 'bg-red' : 'danger';
                break;
        }

        return $bgClass;
    }
}

if (! function_exists('report')) {
    /**
     * Helper to get divide and prevent division by zero
     *
     * @return mixed
     */
    function report($one, $two, $rounded = true)
    {
    	if ($one === 0 || $two === 0) {
    		return 0;
    	}

    	$report = $one/$two;

    	return $rounded ? round($report, 2) : $report;
    }
}
