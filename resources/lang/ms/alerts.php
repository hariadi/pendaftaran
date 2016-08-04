<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'permissions' => [
            'created' => 'Kebenaran telah ditambah.',
            'deleted' => 'Kebenaran telah dihapus.',

            'groups'  => [
                'created' => 'Kebenaran kumpulan telah ditambah.',
                'deleted' => 'Kebenaran kumpulan telah dihapus.',
                'updated' => 'Kebenaran kumpulan telah dikemaskini.',
            ],

            'updated' => 'Kebenaran telah dikemaskini.',
        ],

        'roles' => [
	        'created' => 'Peranan telah ditambah.',
	        'deleted' => 'Peranan telah dihapus.',
	        'updated' => 'Peranan telah dikemaskini.',
	    ],

        'users' => [
            'confirmation_email' => 'Emel pengesahan telah pun dihantar.',
            'created' => 'Akaun pengguna telah ditambah.',
            'deleted' => 'Akaun pengguna telah dihapus.',
            'deleted_permanently' => 'Akaun pengguna telah dihapus dari pangkalan data.',
            'restored' => 'Akaun pengguna telah dipulihkan.',
            'updated' => 'Akaun pengguna telah dikemaskini.',
            'updated_password' => "Katalaluan pengguna telah dikemaskini.",
            'send_confirmation_email' => 'Hantar Emel Pengesahan',
        	'resend_confirmation_email' => 'Hantarkan semula emel pengesahan',
        ],

        'agency' => [
            'created' => 'Agensi telah ditambah.',
            'deleted' => 'Agensi telah dihapus.',
            'deleted_permanently' => 'Agensi telah dihapus dari pangkalan data.',
            'restored' => 'Agensi telah dipulihkan.',
            'updated' => 'Agensi telah dikemaskini.',
        ],

        'event' => [
            'created' => 'Aktiviti telah ditambah.',
            'deleted' => 'Aktiviti telah dihapus.',
            'deleted_permanently' => 'Aktiviti telah dihapus dari pangkalan data.',
            'restored' => 'Aktiviti telah dipulihkan.',
            'updated' => 'Aktiviti telah dikemaskini.',
        ],

        'participant' => [
        	'added' => 'Peserta telah ditambah ke dalam aktiviti.',
            'created' => 'Peserta telah ditambah.',
            'deleted' => 'Peserta telah dihapus.',
            'deleted_permanently' => 'Peserta telah dihapus dari pangkalan data.',
            'restored' => 'Peserta telah dipulihkan.',
            'updated' => 'Peserta telah dikemaskini.',
        ],
    ],
];
