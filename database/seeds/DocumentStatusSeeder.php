<?php

use Illuminate\Database\Seeder;

class DocumentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'แบบร่าง',
                'color' => 'grey'
            ],
            [
                'name' => 'กำลังดำเนินการ',
                'color' => 'yellow'
            ],
            [
                'name' => 'สำเร็จ',
                'color' => 'green'
            ],
            [
                'name' => 'ไม่อนุมัติ',
                'color' => 'red'
            ],
            [
                'name' => 'ยกเลิก',
                'color' => 'black'
            ],
        ];
        foreach($colors as $item) {
            App\Models\DocumentStatus::create($item) ;

        }
    }
}
