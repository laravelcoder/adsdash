<?php

use Illuminate\Database\Seeder;

class VariableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Dish example percentage', 'value' => '10',],

        ];

        foreach ($items as $item) {
            \App\Variable::create($item);
        }
    }
}
