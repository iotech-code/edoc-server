<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[
            [
                'name' => 'admin'
            ],
            [
                'name' => 'officer'
            ]
        ];

        foreach($roles as $r) {
            App\Models\Role::create($r);
        }
    }
}
