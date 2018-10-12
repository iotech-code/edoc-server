<?php

use Illuminate\Database\Seeder;

use App\Models\BackOfficeUser ;

class BackOfficeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'user_id' => 'default1',
            'password' => bcrypt('default'),
            'email' => '',
            'first_name' => 'Default1',
            'last_name' => '',
        ];

        BackOfficeUser::create($user);
    }
}
