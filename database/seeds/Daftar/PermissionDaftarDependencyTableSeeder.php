<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionDaftarDependencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            DB::table(config('access.permission_dependencies_table'))->truncate();
        } elseif (env('DB_CONNECTION') == 'sqlite') {
            DB::statement('DELETE FROM ' . config('access.permission_dependencies_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE ' . config('access.permission_dependencies_table') . ' CASCADE');
        }

        $permission1Id = DB::table('permissions')->where('name', 'view-backend')->first()->id;
        $permission2Id = DB::table('permissions')->where('name', 'view-access-management')->first()->id;


        foreach (config('daftar.roles') as $role) {

        	foreach (config('daftar.permissions') as $permission) {

        		$permissionId = DB::table('permissions')->where('name', str_slug($permission . '-' . $role))->first()->id;

				DB::table(config('access.permission_dependencies_table'))->insert([
					'permission_id' => $permissionId,
					'dependency_id' => $permission1Id,
					'created_at'    => Carbon::now(),
					'updated_at'    => Carbon::now(),
				]);

				DB::table(config('access.permission_dependencies_table'))->insert([
					'permission_id' => $permissionId,
					'dependency_id' => $permission2Id,
					'created_at'    => Carbon::now(),
					'updated_at'    => Carbon::now(),
				]);

			}
		}
    }
}
