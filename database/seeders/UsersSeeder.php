<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $i = -1;
        while ($this->command->confirm('Add '.($i++ ? 'an' : 'another').' admin user?')) {
            $name = $this->command->ask('Name');
            $mail = $this->command->ask("{$name}'s email");
            $pass = $this->command->secret("{$name}'s password");

            DB::table('users')->insert([
                'name' => $name,
                'email' => $mail,
                'password' => bcrypt($pass),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Admin Role
            DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_type' => User::class,
                'model_id' => DB::getPdo()->lastInsertId(),
            ]);
        }
    }
}
