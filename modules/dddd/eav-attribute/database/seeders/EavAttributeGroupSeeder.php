<?php

namespace DDDD\EAVAttribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EavAttributeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eav_attribute_group')->upsert(
            [
                // product
                [
                    'uid' => 'product_content',
                    'attribute_group_name' => 'Product Contents',
                    'is_system' => true
                ],
                [
                    'uid' => 'product_image',
                    'attribute_group_name' => 'Product Images',
                    'is_system' => true
                ],
                [
                    'uid' => 'product_price',
                    'attribute_group_name' => 'Product Price',
                    'is_system' => true
                ],

                // category
                [
                    'uid' => 'category_content',
                    'attribute_group_name' => 'Category Contents',
                    'is_system' => true
                ],
                [
                    'uid' => 'category_image',
                    'attribute_group_name' => 'Category Images',
                    'is_system' => true
                ],

                // meta
                [
                    'uid' => 'meta_seo',
                    'attribute_group_name' => 'Meta SEO',
                    'is_system' => true
                ]
            ],
            ['uid'],
            [
                'attribute_group_name',
                'is_system'
            ]
        );
    }
}
