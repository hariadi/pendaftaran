<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Ruangan :attribute mesti diterima.',
    'active_url'           => 'Ruangan :attribute tidak mengandungi pautan yang sah.',
    'after'                => 'Ruangan :attribute mestilah tarikh selepas :date.',
    'alpha'                => 'Ruangan :attribute hendaklah mengandungi perkataan.',
    'alpha_dash'           => 'Ruangan :attribute hendaklah mengandungi perkataan, nombor, dan dash.',
    'alpha_num'            => 'Ruangan :attribute hendaklah mengandungi perkataan dan nombor.',
    'array'                => 'Ruangan :attribute must be an array.',
    'before'               => 'Ruangan :attribute mesti dalam bentuk tarikh sebelum :date.',
    'between'              => [
        'numeric' => 'Ruangan :attribute mesti diantara :min dan :max..',
        'file'    => 'Ruangan :attribute mesti diantara :min dan :max. kilobytes.',
        'string'  => 'Ruangan :attribute mesti diantara :min dan :max. karakter.',
        'array'   => 'Ruangan :attribute mesti mempunyai item diantara :min dan :max.',
    ],
    'boolean'              => 'Ruangan :attribute field must be true or false.',
    'confirmed'            => 'Ruangan :attribute pengesahan tidak padan.',
    'date'                 => 'Ruangan :attribute adalah bukan tarikh yang sah.',
    'date_format'          => 'Ruangan :attribute does not match the format :format.',
    'different'            => 'Ruangan :attribute and :other must be different.',
    'digits'               => 'Ruangan :attribute must be :digits digits.',
    'digits_between'       => 'Ruangan :attribute mesti diantara :min dan :max. digits.',
    'distinct'             => 'Ruangan :attribute field has a duplicate value.',
    'email'                => 'Ruangan :attribute hendaklah mengandungi alamat emel yang sah.',
    'exists'               => 'The selected :attribute is invalid.',
    'filled'               => 'Ruangan :attribute field is required.',
    'image'                => 'Ruangan :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'Ruangan :attribute field does not exist in :other.',
    'integer'              => 'Ruangan :attribute must be an integer.',
    'ip'                   => 'Ruangan :attribute must be a valid IP address.',
    'json'                 => 'Ruangan :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Ruangan :attribute may not be greater than :max.',
        'file'    => 'Ruangan :attribute may not be greater than :max kilobytes.',
        'string'  => 'Ruangan :attribute may not be greater than :max characters.',
        'array'   => 'Ruangan :attribute may not have more than :max items.',
    ],
    'mimes'                => 'Ruangan :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Ruangan :attribute must be at least :min.',
        'file'    => 'Ruangan :attribute must be at least :min kilobytes.',
        'string'  => 'Ruangan :attribute must be at least :min characters.',
        'array'   => 'Ruangan :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'Ruangan :attribute must be a number.',
    'present'              => 'Ruangan :attribute field must be present.',
    'regex'                => 'Ruangan :attribute format is invalid.',
    'required'             => 'Ruangan :attribute perlu diisi.',
    'required_if'          => 'Ruangan :attribute field is required when :other is :value.',
    'required_unless'      => 'Ruangan :attribute field is required unless :other is in :values.',
    'required_with'        => 'Ruangan :attribute field is required when :values is present.',
    'required_with_all'    => 'Ruangan :attribute field is required when :values is present.',
    'required_without'     => 'Ruangan :attribute field is required when :values is not present.',
    'required_without_all' => 'Ruangan :attribute field is required when none of :values are present.',
    'same'                 => 'Ruangan :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'Ruangan :attribute must be :size.',
        'file'    => 'Ruangan :attribute must be :size kilobytes.',
        'string'  => 'Ruangan :attribute must be :size characters.',
        'array'   => 'Ruangan :attribute must contain :size items.',
    ],
    'string'               => 'Ruangan :attribute must be a string.',
    'timezone'             => 'Ruangan :attribute must be a valid zone.',
    'unique'               => 'Ruangan :attribute has already been taken.',
    'url'                  => 'Ruangan :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
    	'participants.*.ic' => [
	        'required' => 'Ruangan No. KP perlu diisi.',
	    ],
	    'participants.*.phone' => [
	        'required' => 'Ruangan Telefon perlu diisi.',
	    ],
    	'participants.*.email' => [
	        'required' => 'Ruangan E-mel perlu diisi.',
	        'email' => 'Ruangan E-mel hendaklah mengandungi alamat emel yang sah.',
	    ],
	    'participants.*.name' => [
	        'required' => 'Ruangan Nama perlu diisi.',
	    ],
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

    	'name' => 'Nama Aktiviti',
    	'location' => 'Lokasi',
    	'start_at' => 'Tarikh Mula',
    	'end_at' => 'Tarikh Tamat',
    	'agency_id' => 'Agensi',
    	'participants.*.email' => 'E-mel',
    	'participants.*.name' => 'Nama',
        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => 'Associated Roles',
                    'dependencies' => 'Dependencies',
                    'display_name' => 'Display Name',
                    'group' => 'Group',
                    'group_sort' => 'Group Sort',

                    'groups' => [
                        'name' => 'Group Name',
                    ],

                    'name' => 'Name',
                    'system' => 'System?',
                ],

                'roles' => [
                    'associated_permissions' => 'Associated Permissions',
                    'name' => 'Name',
                    'sort' => 'Sort',
                ],

                'users' => [
                    'active' => 'Active',
                    'associated_roles' => 'Associated Roles',
                    'confirmed' => 'Confirmed',
                    'email' => 'E-mail Address',
                    'name' => 'Name',
                    'other_permissions' => 'Other Permissions',
                    'password' => 'Katalaluan',
                    'password_confirmation' => 'Pengesahan Kataluan',
                    'send_confirmation_email' => 'Hantar E-men Pengesahan',
                ],
            ],
        ],

        'frontend' => [
        	'agency' => 'Agensi',
            'email' => 'Alamat E-mel',
            'name' => 'Nama',
            'phone' => 'Telefon',
            'address' => 'Alamat Pejabat',
            'password' => 'Katalaluan',
            'password_confirmation' => 'Pengesahan Katalaluan',
            'old_password' => 'Katalaluan lama',
            'new_password' => 'Katalaluan Baru',
            'new_password_confirmation' => 'Pengesahan Katalaluan Baru',
        ],
    ],

];
