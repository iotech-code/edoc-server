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
        // DB::table('documents')->truncate();
        // used variable from App\Database\factorie(s
        factory(App\Models\Document::class, 30)->create()
            ->each(function($doc) {
                $doc->accessibleUsers()->attach(
                    App\Models\User::where('school_id', $doc->school_id)->inRandomOrder()->take(mt_rand(1,3))->get()->pluck(['id'])
                );
            });;
    }
}
