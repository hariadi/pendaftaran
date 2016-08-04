<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
    	'agency' => [
            'create_error' => 'Terdapat masalah dalam membuat agensi ini. Sila cuba lagi.',
            'delete_error' => 'Terdapat masalah untuk menghapus agensi ini. Sila cuba lagi.',
            'not_found' => 'Agensi tersebut tidak wujud.',
            'restore_error' => 'Terdapat masalah untuk restore semula agensi ini. Sila cuba lagi.',
            'update_error' => 'Terdapat masalah dalam mengemaskini agensi ini. Sila cuba lagi.',
        ],
    	'event' => [
            'create_error' => 'Terdapat masalah dalam membuat aktiviti ini. Sila cuba lagi.',
            'delete_error' => 'Terdapat masalah untuk menghapus aktiviti ini. Sila cuba lagi.',
            'not_found' => 'Aktiviti tersebut tidak wujud.',
            'restore_error' => 'Terdapat masalah untuk restore semula aktiviti ini. Sila cuba lagi.',
            'update_error' => 'Terdapat masalah dalam mengemaskini aktiviti ini. Sila cuba lagi.',
        ],
        'access' => [
            'permissions' => [
                'create_error' => 'There was a problem creating this permission. Please try again.',
                'delete_error' => 'There was a problem deleting this permission. Please try again.',

                'groups' => [
                    'associated_permissions' => 'You can not delete this group because it has associated permissions.',
                    'has_children' => 'You can not delete this group because it has child groups.',
                    'name_taken' => 'There is already a group with that name',
                ],

                'not_found' => 'That permission does not exist.',
                'system_delete_error' => 'You can not delete a system permission.',
                'update_error' => 'There was a problem updating this permission. Please try again.',
            ],

            'roles' => [
                'already_exists' => 'That role already exists. Please choose a different name.',
                'cant_delete_admin' => 'You can not delete the Administrator role.',
                'create_error' => 'There was a problem creating this role. Please try again.',
                'delete_error' => 'There was a problem deleting this role. Please try again.',
                'has_users' => 'You can not delete a role with associated users.',
                'needs_permission' => 'You must select at least one permission for this role.',
                'not_found' => 'That role does not exist.',
                'update_error' => 'There was a problem updating this role. Please try again.',
            ],

            'users' => [
                'cant_deactivate_self' => 'You can not do that to yourself.',
                'cant_delete_self' => 'You can not delete yourself.',
                'create_error' => 'There was a problem creating this user. Please try again.',
                'delete_error' => 'There was a problem deleting this user. Please try again.',
                'email_error' => 'That email address belongs to a different user.',
                'mark_error' => 'There was a problem updating this user. Please try again.',
                'not_found' => 'That user does not exist.',
                'restore_error' => 'There was a problem restoring this user. Please try again.',
                'role_needed_create' => 'You must choose at lease one role. User has been created but deactivated.',
                'role_needed' => 'You must choose at least one role.',
                'update_error' => 'There was a problem updating this user. Please try again.',
                'update_password_error' => 'There was a problem changing this users password. Please try again.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Akaun anda telah disahkan sebelum ini.',
                'confirm' => 'Sahkan akaun anda!',
                'created_confirm' => 'Akaun anda telah berjaya didaftarkan. Pihak kami telah menghantar satu emel bagi tujuan pengesahan akaun.',
                'mismatch' => 'Kod pengesahan anda tidak padan.',
                'not_found' => 'Kod pengesahan tersebut tidak wujud.',
                'resend' => 'Akaun anda belum disahkan. Sila klik pautan pengesahan didalam emel yang telah dihantar sebelum ini, atau <a href="' . route('account.confirm.resend', ':token') . '">klik disini</a> untuk menghantar semula emel pengesahan.',
                'success' => 'Tahniah! Akaun anda telah disahkan!',
                'resent' => 'Satu emel pengesahan telah pun dihantar.',
            ],

            'deactivated' => 'Akaun anda telah pun dinyahaktifkan.',
            'email_taken' => 'Emel tersebut telah didaftar sebelum ini.',

            'password' => [
                'change_mismatch' => 'Maklumat tersebut bukan katalaluan lama anda.',
            ],


        ],
    ],
];
