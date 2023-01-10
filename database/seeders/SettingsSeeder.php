<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

        $settings = [
            [
                'key' => 'contact',
                'name' => 'Contacto',
                'description' => '',
                'value' => 'geral@mail.com',
                'field' => '{"name":"value","label":"Value","type":"email"}',
                'active' => 1,
            ],
        ];

        foreach ($settings as $index => $setting) {
            $result = DB::table('settings')->insert($setting);

            if (! $result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
    }
}
