<?php

namespace App\Repositories\Backend\Event;

/**
 * Interface EventContract
 * @package App\Repositories\Backend\Event
 */
interface EventContract
{

    /**
     * Get all instance of Event.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Event[]
     */
    public function all();

   /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getEventsPaginated($per_page = 10, $order_by = 'id', $sort = 'asc');

    /**
     * Find an instance of Event with the given ID.
     *
     * @param  $id
     * @return mixed
     */
    public function findOrThrowException($id);

    /**
     * Create a new instance of Event.
     *
     * @param $input
     * @return mixed
     */
    public function create($input);

    /**
     * Update the Event with the given input.
     *
     * @param  int    $id
     * @param  array  $input
     * @return bool|int
     */
    public function update($id, $input);

    /**
     * Delete an entry with the given ID.
     *
     * @param  int  $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id);

}
