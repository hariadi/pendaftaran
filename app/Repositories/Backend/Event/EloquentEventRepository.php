<?php

namespace App\Repositories\Backend\Event;

use App\Models\Event\Event;
use App\Exceptions\GeneralException;
use App\Repositories\Backend\Event\EventContract;

class EloquentEventRepository implements EventContract
{
    /**
     * Get all instance of Event.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Event[]
     */
    public function all($order_by = 'id', $sort = 'asc')
    {
        return Event::orderBy($order_by, $sort)->get();
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return mixed
     */
    public function findOrThrowException($id)
    {
        $event = Event::find($id);

        if (!is_null($event)) {
            return $event;
        }

        throw new GeneralException('Event not found.');
    }

   /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @param  int         $status
     * @return mixed
     */
    public function getEventsPaginated($per_page = 10, $order_by = 'id', $sort = 'asc')
    {
        return Event::orderBy($order_by, $sort)->paginate($per_page);
    }

   /**
     * Create a new instance of Event.
     *
     * @param  array  $input
     * @return bool
     */
    public function create($input)
    {
        $event = $this->createEventStub($input);

        if ($event->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this event. Please try again.');
    }

    /**
     * Update the Event with the given attributes.
     *
     * @param  int    $id
     * @param  array  $input
     * @return bool|int
     */
    public function update($id, $input)
    {
        $event = $this->findOrThrowException($id);

        if ($event->update($input)) {

            $event->save();

            return true;
        }

        throw new GeneralException('There was a problem updating this event. Please try again.');
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete($id)
    {
        $event = $this->findOrThrowException($id);
        if ($event->delete()) {
            return true;
        }

        throw new GeneralException('There was a problem deleting this event. Please try again.');
    }

    /**
     * @param  $input
     * @return mixed
     */
    private function createEventStub($input)
    {
        $event = new Event;
        $event->name = $input['name'];
        $event->location = $input['location'];
        $event->description = $input['description'];
        $event->start_at = $input['start_at'];
        $event->end_at = $input['end_at'];
        $event->attendant = $input['attendant'];

        return $event;
    }
}
