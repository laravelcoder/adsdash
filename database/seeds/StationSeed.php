<?php

use Illuminate\Database\Seeder;

class StationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'station_label' => 'HBO HD', 'channel_number' => '535', 'provider_id' => 1,],
            ['id' => 2, 'station_label' => 'HBO', 'channel_number' => '515', 'provider_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Station::create($item);
        }
    }
}
