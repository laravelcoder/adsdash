<?php

use Illuminate\Database\Seeder;

class ContentPageSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            1 => [
                'category_id' => [],
                'tag_id' => [],
            ],
            2 => [
                'category_id' => [],
                'tag_id' => [],
            ],
            3 => [
                'category_id' => [1],
                'tag_id' => [],
            ],

        ];

        foreach ($items as $id => $item) {
            $contentPage = \App\ContentPage::find($id);

            foreach ($item as $key => $ids) {
                $contentPage->{$key}()->sync($ids);
            }
        }
    }
}
