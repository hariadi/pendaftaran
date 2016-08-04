<?php

namespace App\Http\Requests\Frontend\Event;

use App\Http\Requests\Request;

class StoreEventRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'name'      => 'required',
			'location'	=> 'required',
			'start_at'  => 'required|date',
			'end_at'   	=> 'required|date',
			'photo'		=> 'image',
		];
    }
}
