<?php

use Illuminate\Database\Seeder;

class TemplateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 3, 'template_name' => 'Main Layout', 'content' => null, 'description' => null,],

        ];

        foreach ($items as $item) {
            \App\Template::create($item);
        }
    }
}
