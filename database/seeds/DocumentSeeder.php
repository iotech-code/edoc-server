<?php

use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->truncate();
        // used variable from App\Database\factorie(s
        factory(App\Models\Document::class, 30)->create();
    }
}
