<?php

namespace App\Http\Requests\Frontend\Event;

use App\Http\Requests\Request;

class StoreParticipantsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return auth()->guest() ?
        [
			'agency_id'	=> 'required',
			'participants.*.name' => 'required',
			'participants.*.email' => 'required|email',
			'participants.*.ic' => 'required',
			'participants.*.phone' => 'required',
		] :
        [
			'agency_id'	=> 'required',
			'participants.*.name' => 'required',
			'participants.*.email' => 'email',
		];
    }
}
