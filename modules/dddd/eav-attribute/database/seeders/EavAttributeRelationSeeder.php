<?php

namespace DDDD\EAVAttribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EavAttributeRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mapGroupAttribute = [
            // product_content
            [
              'attribute_group_id' => 'product_content',
              'attribute_id' => 'product_description',
            ],
            [
              'attribute_group_id' => 'product_content',
              'attribute_id' => 'product_short_description',
            ],
            [
                'attribute_group_id' => 'product_content',
                'attribute_id' => 'alt_thumbnail',
            ],

            // product_image
            [
                'attribute_group_id' => 'product_image',
                'attribute_id' => 'product_thumbnail',
            ],
            [
                'attribute_group_id' => 'product_image',
                'attribute_id' => 'product_gallery',
            ],
            [
                'attribute_group_id' => 'product_image',
                'attribute_id' => 'product_video_link',
            ],

            // product_price
            [
                'attribute_group_id' => 'product_price',
                'attribute_id' => 'product_price',
            ],
            [
                'attribute_group_id' => 'product_price',
                'attribute_id' => 'product_special_price',
            ],

            // category_general
            [
                'attribute_group_id' => 'category_content',
                'attribute_id' => 'category_description',
            ],

            // category_image
            [
                'attribute_group_id' => 'category_image',
                'attribute_id' => 'category_thumbnail',
            ],
            [
                'attribute_group_id' => 'category_image',
                'attribute_id' => 'category_gallery',
            ],

            // meta_seo
            [
                'attribute_group_id' => 'meta_seo',
                'attribute_id' => 'meta_title',
            ],
            [
                'attribute_group_id' => 'meta_seo',
                'attribute_id' => 'meta_description',
            ],
            [
                'attribute_group_id' => 'meta_seo',
                'attribute_id' => 'meta_keyword',
            ],
            [
                'attribute_group_id' => 'meta_seo',
                'attribute_id' => 'meta_thumbnail',
            ],
            [
                'attribute_group_id' => 'meta_seo',
                'attribute_id' => 'meta_index',
            ],
            [
                'attribute_group_id' => 'meta_seo',
                'attribute_id' => 'meta_follow',
            ],
            [
                'attribute_group_id' => 'meta_seo',
                'attribute_id' => 'canonical_tag',
            ],
        ];

        $dataInsert = [];

        foreach ($mapGroupAttribute as $item) {
            $attrGroupId = DB::table('eav_attribute_group')
                ->where('uid', $item['attribute_group_id'])
                ->pluck('attribute_group_id');
            $attrId = DB::table('eav_attribute')
                ->where('attribute_default_name', $item['attribute_id'])
                ->pluck('attribute_id');
            $dataInsert[] = [
                'attribute_group_id' => current($attrGroupId->toArray()),
                'attribute_id' => current($attrId->toArray())
            ];
        }
        DB::table('eav_attribute_relation')->upsert($dataInsert,['attribute_group_id', 'attribute_id']);
    }
}
