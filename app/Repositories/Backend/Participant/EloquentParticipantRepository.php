<?php

namespace App\Repositories\Backend\Participant;

use App\Models\Participant\Participant;
use App\Exceptions\GeneralException;
use App\Repositories\Backend\Event\EventContract;

class EloquentParticipantRepository implements ParticipantContract
{
    /**
     * @var ParticipantContract
     */
    protected $event;

    /**
     * @param ParticipantContract $event
     */
    public function __construct(EventContract $event)
    {
        $this->event = $event;
    }

    /**
     * Get all instance of Participant.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Participant[]
     */
    public function all($order_by = 'id', $sort = 'asc')
    {
        return Participant::orderBy($order_by, $sort)->get();
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return mixed
     */
    public function findOrThrowException($id)
    {
        $participant = Participant::find($id);

        if (!is_null($participant)) {
            return $participant;
        }

        throw new GeneralException('Participant not found.');
    }

   /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @param  int         $status
     * @return mixed
     */
    public function getParticipantsPaginated($per_page = 10, $order_by = 'id', $sort = 'asc')
    {
        return Participant::orderBy($order_by, $sort)->paginate($per_page);
    }

   /**
     * Create a new instance of Participant.
     *
     * @param  array  $input
     * @return bool
     */
    public function create($input)
    {
        $participant = $this->createParticipantStub($input);

        if ($participant->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this participant. Please try again.');
    }

    /**
     * Update the Participant with the given attributes.
     *
     * @param  int    $id
     * @param  array  $input
     * @return bool|int
     */
    public function update($id, $input)
    {
        $participant = $this->findOrThrowException($id);

        if ($participant->update($input)) {

            $participant->save();

            return true;
        }

        throw new GeneralException('There was a problem updating this participant. Please try again.');
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete($id)
    {
        $participant = $this->findOrThrowException($id);
        if ($participant->delete()) {
            return true;
        }

        throw new GeneralException('There was a problem deleting this participant. Please try again.');
    }

    /**
     * @param  $input
     * @return mixed
     */
    private function createParticipantStub($input)
    {
        $participant                    = new Participant;
        $participant->name              = $input['name'];

        return $participant;
    }
}
