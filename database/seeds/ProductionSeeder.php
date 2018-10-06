<?php

use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SchoolSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DocReplyTypeSeeder::class);
        $this->call(CabinetSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(DocumentStatusSeeder::class);
        // $this->call(DocumentSeeder::class);
        
    }
}
