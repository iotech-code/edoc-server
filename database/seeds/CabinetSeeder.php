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
        DB::table('cabinets')->truncate();
        DB::table('folders')->truncate();

        factory(App\Models\Cabinet::class, 10)->create()->each(function($cabinet){
            $cabinet->folders()->saveMany(factory(App\Models\Folder::class, mt_rand(1,4))->make());
        });

    }
}
