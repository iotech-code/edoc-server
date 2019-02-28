<?php

use Illuminate\Database\Seeder;

class CabinetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = [
            [
                'name' => "วิชาการ",
                "school_id"=> 1,
                "description" => ""
            ],
            [
                'name' => "ธุรการ",
                "school_id"=> 1,
                "description" => ""
            ],
            [
                'name' => "ปกครอง",
                "school_id"=> 1,
                "description" => ""
            ],
            [
                'name' => "การเงิน",
                "school_id"=> 1,
                "description" => ""
            ],
            
        ];
        foreach($a as $data) {
            $cabinet = App\Models\Cabinet::create($data) ;
            $cabinet->folders()->saveMany(factory(App\Models\Folder::class, mt_rand(1,4))->make());
            $users = App\Models\User::inRandomOrder()->take(3)->get();
            $cabinet->permissions()->sync($users->pluck(['id']));

        }

    }
}
