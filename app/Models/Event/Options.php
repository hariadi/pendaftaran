<?php

namespace App\Models\Event;

use Exception;

class Options
{
    /**
     * The Event instance.
     *
     * @var Event
     */
    protected $event;

    /**
     * The list of options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * Create a new options instance.
     *
     * @param array $options
     * @param Event $event
     */
    public function __construct(array $options, Event $event)
    {
        $this->options = $options;
        $this->event = $event;
    }

    /**
     * Retrieve the given option.
     *
     * @param  string $key
     * @return string
     */
    public function get($key)
    {
        return array_get($this->options, $key);
    }

    /**
     * Create and persist a new option.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->options[$key] = $value;

        $this->persist();
    }

    /**
     * Determine if the given option exists.
     *
     * @param  string $key
     * @return boolean
     */
    public function has($key)
    {
        return array_key_exists($key, $this->options);
    }

    /**
     * Retrieve an array of all options.
     *
     * @return array
     */
    public function all()
    {
        return $this->options;
    }

    /**
     * Merge the given attributes with the current options.
     * But do not assign any new options.
     *
     * @param  array  $attributes
     * @return mixed
     */
    public function merge(array $attributes)
    {
        $this->options = array_merge(
            $this->options,
            array_only($attributes, array_keys($this->options))
        );

        return $this->persist();
    }

    /**
     * Persist the options.
     *
     * @return mixed
     */
    protected function persist()
    {
        return $this->event->update(['options' => $this->options]);
    }

    /**
     * Magic property access for options.
     *
     * @param  string $key
     * @throws Exception
     * @return
     */
    public function __get($key)
    {
        if ($this->has($key)) {
            return $this->get($key);
        }

        throw new Exception("The {$key} option does not exist.");
    }
}
