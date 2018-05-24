<?php

use Illuminate\Database\Seeder;

class TeamSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Developers',],
            ['id' => 2, 'name' => 'Dish Sales',],
            ['id' => 3, 'name' => 'Company Rep',],
            ['id' => 4, 'name' => 'Ad Agencies',],

        ];

        foreach ($items as $item) {
            \App\Team::create($item);
        }
    }
}
