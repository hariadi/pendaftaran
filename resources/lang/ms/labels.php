<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => 'Semua',
        'yes' => 'Ya',
        'no' => 'Tidak',
        'custom' => 'Custom',
        'actions' => 'Tindakan',
        'buttons' => [
            'save' => 'Simpan',
            'update' => 'Kemaskini',
        ],
        'hide' => 'Sorok',
        'none' => 'Tiada',
        'show' => 'Papar',
        'toggle_navigation' => 'Toggle Navigasi',
    ],

    'backend' => [

    	'report' => [
    		'title' => 'Laporan',
    		'management' => 'Pengurusan Laporan',
    	],

        'access' => [
            'permissions' => [
                'create' => 'Create Permission',
                'dependencies' => 'Dependencies',
                'edit' => 'Edit Permission',

                'groups' => [
                    'create' => 'Create Group',
                    'edit' => 'Edit Group',

                    'table' => [
                        'name' => 'Name',
                    ],
                ],

                'grouped_permissions' => 'Grouped Permissions',
                'label' => 'permissions',
                'management' => 'Permission Management',
                'no_groups' => 'There are no permission groups.',
                'no_permissions' => 'No permission to choose from.',
                'no_roles' => 'No Roles to set',
                'no_ungrouped' => 'There are no ungrouped permissions.',

                'table' => [
                    'dependencies' => 'Dependencies',
                    'group' => 'Group',
                    'group-sort' => 'Group Sort',
                    'name' => 'Name',
                    'permission' => 'Permission',
                    'roles' => 'Roles',
                    'system' => 'System',
                    'total' => 'permission total|permissions total',
                    'users' => 'Users',
                ],

                'tabs' => [
                    'general' => 'General',
                    'groups' => 'All Groups',
                    'dependencies' => 'Dependencies',
                    'permissions' => 'All Permissions',
                ],

                'ungrouped_permissions' => 'Ungrouped Permissions',
            ],

            'roles' => [
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions' => 'Permissions',
                    'role' => 'Role',
                    'sort' => 'Sort',
                    'total' => 'role total|roles total',
                ],
            ],

            'users' => [
                'active' => 'Pengguna Aktif',
                'all_permissions' => 'All Permissions',
                'change_password' => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'dependencies' => 'Dependencies',
                'edit' => 'Edit User',
                'management' => 'User Management',
                'no_other_permissions' => 'No Other Permissions',
                'no_permissions' => 'No Permissions',
                'no_roles' => 'No Roles to set.',
                'permissions' => 'Permissions',
                'permission_check' => 'Checking a permission will also check its dependencies, if any.',

                'table' => [
                    'confirmed' => 'Disahkan',
                    'created' => 'Dicipta',
                    'email' => 'E-mel',
                    'id' => 'ID',
                    'last_updated' => 'Kemaskini Terakhir',
                    'name' => 'Nama',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted' => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'roles' => 'Roles',
                    'total' => 'pengguna',
                ],
            ],
        ],

        'agency' => [
        	'edit' => 'Kemaskini Agensi',
        	'table' => [
        		'total' => 'agensi',
        	],
        ],

        'event' => [
        	'management' => 'Pengurusan Aktiviti',
        	'create' => 'Cipta Aktiviti',
        	'title' => 'Aktiviti',
    		'name' => 'Aktiviti',
    		'id' => 'ID',
    		'start' => 'Mula',
    		'end' => 'Tamat',
    		'participants' => 'Bil. Peserta',
    		'days' => 'Bil. Hari',
        	'edit' => 'Kemaskini Aktiviti',
        	'table' => [
        		'total' => 'aktiviti',
        	],
        ],

        'participant' => [
        	'management' => 'Pengurusan Peserta',
        	'create' => 'Peserta Baru',
        	'edit' => 'Kemaskini Peserta',
        	'id' => 'ID',
        	'name' => 'Nama',
			'ic' => 'No. KP',
			'phone' => 'Telefon',
			'email' => 'E-Mel',
			'agency' => 'Agency',
			'job_title' => 'Jawatan',
			'grade' => 'Gred',
        	'table' => [
        		'total' => 'peserta',
        	],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title' => 'Log Masuk',
            'login_button' => 'Log Masuk',
            'login_with' => 'Log Masuk melalui :social_media',
            'register_box_title' => 'Pendaftaran AIPSM',
            'register_button' => 'Daftar',
            'remember_me' => 'Ingatkan Saya',
        ],

        'passwords' => [
            'forgot_password' => 'Lupa Katalaluan?',
            'reset_password_box_title' => 'Set Semula Katalaluan',
            'reset_password_button' => 'Set Semula',
            'send_password_reset_link_button' => 'Hantar Pautan Set Semula Katalaluan',
        ],

        'macros' => [
            'country' => [
                'alpha' => 'Country Alpha Codes',
                'alpha2' => 'Country Alpha 2 Codes',
                'alpha3' => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us' => [
                    'us' => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed' => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Tukar Katalaluan',
            ],

            'profile' => [
                'avatar' => 'Avatar',
                'created_at' => 'Dicipta Pada',
                'edit_information' => 'Kemaskini Maklumat',
                'email' => 'E-mel',
                'last_updated' => 'Kemaskini Akhir',
                'name' => 'Nama',
                'phone' => 'Telefon',
                'update_information' => 'Kemaskini Maklumat',
            ],
        ],

    ],
];
