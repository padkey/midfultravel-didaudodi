<?php

namespace DDDD\EAVAttribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EavAttributeSetGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dataMapping = [
            // product
            [
                'attribute_group_id' => 'product_content',
                'attribute_set_id' => 'catalog-product',
            ],
            [
                'attribute_group_id' => 'product_image',
                'attribute_set_id' => 'catalog-product',
            ],
            [
                'attribute_group_id' => 'product_price',
                'attribute_set_id' => 'catalog-product',
            ],
            [
                'attribute_group_id' => 'meta_seo',
                'attribute_set_id' => 'catalog-product',
            ],

            // category
            [
                'attribute_group_id' => 'category_content',
                'attribute_set_id' => 'catalog-category',
            ],
            [
                'attribute_group_id' => 'category_image',
                'attribute_set_id' => 'catalog-category',
            ],
            [
                'attribute_group_id' => 'meta_seo',
                'attribute_set_id' => 'catalog-category',
            ],
        ];

        $dataInsert = [];
        foreach ($dataMapping as $item) {
            $attrGroupId = DB::table('eav_attribute_group')
                ->where('uid', $item['attribute_group_id'])
                ->pluck('attribute_group_id');
            $attrSetId = DB::table('eav_attribute_set')
                ->where('uid', $item['attribute_set_id'])
                ->pluck('attribute_set_id');
            $dataInsert[] = [
                'attribute_group_id' => current($attrGroupId->toArray()),
                'attribute_set_id' => current($attrSetId->toArray())
            ];
        }
        DB::table('eav_attribute_set_group')->upsert($dataInsert,['attribute_group_id', 'attribute_set_id']);
    }
}
