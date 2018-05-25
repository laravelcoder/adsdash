<?php

use Illuminate\Database\Seeder;

class NetworkSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'network' => 'PBS', 'network_affiliate' => 'BYU',],

        ];

        foreach ($items as $item) {
            \App\Network::create($item);
        }
    }
}
