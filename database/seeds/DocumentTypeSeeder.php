<?php

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            // หนังสือภายนอก
            [
                'name' => "หนังสือภายนอก"
            ],
            // หนังสือภายใน 
            [
                'name' => "หนังสือภายใน"
            ],
            // หนังสือประทับตรา 
            [
                'name' => "หนังสือประทับตรา"
            ],
            // หนังสือสั่งการ 
            [
                'name' => "หนังสือสั่งการ คำสั่ง"
            ],
            [
                'name' => "หนังสือสั่งการ ระเบียบ"
            ],
            [
                'name' => "หนังสือสั่งการ ข้อบังคับ"
            ],
            // หนังสือประชาสัมพันธ์
            [
                'name' => "ประกาศ"
            ],
            [
                'name' => "แถลงการณ์"
            ],
            [
                'name' => "ข่าว"
            ],
            // หนังสือที่เจ้าหน้าที่ทำขึ้นหรือรับไว้เป็นหลักฐานในราชการ
            [
                'name' => "หนังสือรับรอง"
            ],
            [
                'name' => "รายงานการประชุม"
            ],
            [
                'name' => "บันทึก"
            ],
            [
                'name' => "หนังสืออื่นๆ"
            ],
            // เอกสารตอบกลับ
            // [
            //     'name' => "เอกสารตอบกลับ"
            // ],

        ];
        // DB::table("document_types")->saveMany($types);
        // for($i=1;$i<=8;$i++) {
            App\Models\DocumentType::insert($types);
        // }
    }
}
