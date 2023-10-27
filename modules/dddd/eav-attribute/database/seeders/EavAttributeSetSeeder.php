<?php

namespace DDDD\EAVAttribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EavAttributeSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eav_attribute_set')->upsert(
            [
                [
                    'uid' => 'catalog-product',
                    'attribute_set_name' => 'catalog-product',
                    'attribute_set_group' => 'product',
                    'is_system' => true
                ],
                [
                    'uid' => 'catalog-category',
                    'attribute_set_name' => 'catalog-category',
                    'attribute_set_group' => 'category',
                    'is_system' => true
                ]
            ],
            ['uid',  'attribute_set_group'],
            [
                'is_system',
                'attribute_set_name'
            ]
        );
    }
}
