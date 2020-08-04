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
            'user_id' => 'officer01',
            'password' => bcrypt('!password'),
            'email' => '',
            'first_name' => 'Default1',
            'last_name' => '',
        ];

        BackOfficeUser::create($user);
    }
}
