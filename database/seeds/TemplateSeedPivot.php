<?php

use Illuminate\Database\Seeder;

class TemplateSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            3 => [
                'pages' => [1],
            ],

        ];

        foreach ($items as $id => $item) {
            $template = \App\Template::find($id);

            foreach ($item as $key => $ids) {
                $template->{$key}()->sync($ids);
            }
        }
    }
}
