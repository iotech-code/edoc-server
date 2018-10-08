<?php

use Illuminate\Database\Seeder;

use App\Models\User ;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('users')->truncate();
        User::create([
            'user_id' => 'admin@sh1',
            'first_name' => "Admin",
            'last_name' => "Admin",
            'email' => "",
            'school_id' => 1,
            'role_id' => 1,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        ]);
        User::create([
            'user_id' => 'secret@sh1',
            'first_name' => "เลขา",
            'last_name' => "ทดสอบ",
            'email' => "",
            'school_id' => 1,
            'role_id' => 2,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        ]);
        User::create([
            'user_id' => 'director@sh1',
            'first_name' => "ผู้อำนวยการ",
            'last_name' => "ทดสอบ",
            'email' => "",
            'school_id' => 1,
            'role_id' => 2,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        ]);
        User::create([ 
            'user_id' => 'tester1@sh1',
            'first_name' => "คุณครู1",
            'last_name' => "ทดสอบ",
            'email' => "",
            'school_id' => 1,
            'role_id' => 2,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        ]);
        User::create([ 
            'user_id' => 'tester2@sh1',
            'first_name' => "คุณครู2",
            'last_name' => "ทดสอบ",
            'email' => "",
            'school_id' => 1,
            'role_id' => 2,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        ]);

        User::create([ 
            'user_id' => 'tester1@sh2',
            'first_name' => "คุณครู1 รร.2",
            'last_name' => "ทดสอบ",
            'email' => "",
            'school_id' => 1,
            'role_id' => 2,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10),
        ]);
    }
}
