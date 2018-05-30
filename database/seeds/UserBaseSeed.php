<?php

use Illuminate\Database\Seeder;

class UserBaseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Dish User Base', 'value' => '10000000', 'created_by_team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\UserBase::create($item);
        }
    }
}
