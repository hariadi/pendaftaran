<?php

namespace App\Repositories\Backend\Participant;

/**
 * Interface ParticipantContract
 * @package App\Repositories\Backend\Participant
 */
interface ParticipantContract
{

    /**
     * Get all instance of Participant.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Participant[]
     */
    public function all();

   /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getParticipantsPaginated($per_page = 10, $order_by = 'id', $sort = 'asc');

    /**
     * Find an instance of Participant with the given ID.
     *
     * @param  $id
     * @return mixed
     */
    public function findOrThrowException($id);

    /**
     * Create a new instance of Participant.
     *
     * @param $input
     * @return mixed
     */
    public function create($input);

    /**
     * Update the Participant with the given input.
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
