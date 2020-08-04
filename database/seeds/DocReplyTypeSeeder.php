<?php

use Illuminate\Database\Seeder;
use App\Models\DocumentReplyType ;

class DocReplyTypeSeeder extends Seeder
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
                'name' => "แจ้งมาเพื่อทราบ"
            ],
            [
                'name' => "แจ้งมาเพื่อทราบ และพิจารณา"
            ],
        ];
        foreach ($a as $data) {
            DocumentReplyType::create($data);
        }
    }
}
