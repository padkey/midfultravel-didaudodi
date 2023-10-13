<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DDDD\Blog\Models\Locale;
class LocaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Locale::create(
            [
            'name' => 'English',
            'code' => 'en'
            ]
        );
        Locale::create(
            [
                'name' => 'VietNam',
                'code' => 'vi'
            ]
        );
    }
}
