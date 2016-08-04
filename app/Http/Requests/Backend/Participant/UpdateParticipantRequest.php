<?php

namespace App\Http\Requests\Backend\Participant;

use App\Http\Requests\Request;

class UpdateParticipantRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-participant');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'name'	=> 'required',
			'email'	=> 'email',
		];
    }
}
