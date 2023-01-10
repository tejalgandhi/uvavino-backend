<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use GemaDigital\Framework\app\Helpers\EnumHelper;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();

        $date = Carbon::now();

        // Roles
        foreach (EnumHelper::values('user.roles') as $role) {
            DB::table('roles')->insert([
                'name' => $role,
                'guard_name' => 'backpack',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        // Permissions
        foreach (EnumHelper::values('user.permissions') as $i => $permission) {
            DB::table('permissions')->insert([
                'name' => $permission,
                'guard_name' => 'backpack',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
