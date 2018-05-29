<?php

use Illuminate\Database\Seeder;

class AdSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'ad_label' => 'test label', 'created_by_id' => null, 'ad_description' => null, 'total_impressions' => 65, 'total_networks' => 21, 'total_channels' => 11,],

        ];

        foreach ($items as $item) {
            \App\Ad::create($item);
        }
    }
}
