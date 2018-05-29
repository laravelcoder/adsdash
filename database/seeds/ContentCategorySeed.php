<?php

use Illuminate\Database\Seeder;

class ContentCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Dashboards', 'slug' => 'dashboards',],

        ];

        foreach ($items as $item) {
            \App\ContentCategory::create($item);
        }
    }
}
