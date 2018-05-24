<?php

use Illuminate\Database\Seeder;

class ChannelSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'channel' => 4, 'channel_name' => 'CBS',],
            ['id' => 2, 'channel' => 13, 'channel_name' => 'FOX',],
            ['id' => 3, 'channel' => 5, 'channel_name' => 'NBC',],

        ];

        foreach ($items as $item) {
            \App\Channel::create($item);
        }
    }
}
