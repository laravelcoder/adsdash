<?php

use Illuminate\Database\Seeder;

class StylesheetSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 2, 'link' => ' <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">', 'template_id' => 3,],
            ['id' => 3, 'link' => '<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">', 'template_id' => 3,],
            ['id' => 4, 'link' => '<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">', 'template_id' => 3,],
            ['id' => 5, 'link' => '<meta name="viewport" content="width=device-width, initial-scale=1">', 'template_id' => 3,],

        ];

        foreach ($items as $item) {
            \App\Stylesheet::create($item);
        }
    }
}
