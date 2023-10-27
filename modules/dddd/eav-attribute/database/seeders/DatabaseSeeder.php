<?php

namespace DDDD\EAVAttribute\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EavAttributeSeeder::class);
        $this->call(EavAttributeSetSeeder::class);
        $this->call(EavAttributeGroupSeeder::class);
        $this->call(EavAttributeRelationSeeder::class);
        $this->call(EavAttributeSetGroupSeeder::class);
    }
}
