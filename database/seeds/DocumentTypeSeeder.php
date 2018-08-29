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
        for($i=1;$i<=8;$i++) {
            App\Models\DocumentType::create([
                "name" => "ประเภททดสอบ $i"
            ]);
        }
    }
}
