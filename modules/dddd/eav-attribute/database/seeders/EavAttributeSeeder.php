<?php

namespace DDDD\EAVAttribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EavAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eav_attribute')->upsert(
            [
                // catalog-product
                [
                    'attribute_default_name' => 'product_description',
                    'attribute_type' => 'editor',
                    'is_require' => false,
                    'is_system' => true

                ],
                [
                    'attribute_default_name' => 'product_short_description',
                    'attribute_type' => 'editor',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'product_price',
                    'attribute_type' => 'decimal',
                    'is_require' => true,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'product_special_price',
                    'attribute_type' => 'decimal',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'product_thumbnail',
                    'attribute_type' => 'image',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'product_gallery',
                    'attribute_type' => 'gallery',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'product_video_link',
                    'attribute_type' => 'varchar',
                    'is_require' => false,
                    'is_system' => true
                ],

                // catalog-category
                [
                    'attribute_default_name' => 'category_thumbnail',
                    'attribute_type' => 'image',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'category_gallery',
                    'attribute_type' => 'gallery',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'category_description',
                    'attribute_type' => 'editor',
                    'is_require' => false,
                    'is_system' => true
                ],

                // meta
                [
                    'attribute_default_name' => 'meta_title',
                    'attribute_type' => 'varchar',
                    'is_require' => true,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'meta_description',
                    'attribute_type' => 'text',
                    'is_require' => true,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'meta_keyword',
                    'attribute_type' => 'varchar',
                    'is_require' => true,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'meta_thumbnail',
                    'attribute_type' => 'image',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'meta_index',
                    'attribute_type' => 'boolean',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'meta_follow',
                    'attribute_type' => 'boolean',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'canonical_tag',
                    'attribute_type' => 'varchar',
                    'is_require' => false,
                    'is_system' => true
                ],
                [
                    'attribute_default_name' => 'alt_thumbnail',
                    'attribute_type' => 'varchar',
                    'is_require' => false,
                    'is_system' => true
                ]
            ],
            ['attribute_default_name'],
            [
                'attribute_type',
                'is_require',
                'is_system'
            ]
        );
    }
}
