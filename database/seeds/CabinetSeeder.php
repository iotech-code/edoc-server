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

        for($i=1;$i<10;$i++) {
            App\Models\Cabinet::create([
                'name' => "ตู้ทดสอบ $i",
                "description" => ""
            ]);
        }
    }
}
