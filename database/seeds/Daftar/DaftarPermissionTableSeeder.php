<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Access\Role\Role;
use App\Models\Access\Permission\Permission;

class DaftarPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (config('daftar.roles') as $role) {

        	foreach (config('daftar.permissions') as $permission) {

				$permit               = new Permission;
				$permit->name         = str_slug($permission . '-' . $role);
				$permit->display_name = $permission . ' ' . $role;
				$permit->group_id     = 4;
				$permit->created_at   = Carbon::now();
				$permit->updated_at   = Carbon::now();
				$permit->save();

				Role::where('id', '!=', 1)->first()->attachPermission($permit);

			}
		}
    }
}
