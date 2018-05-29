<?php

use Illuminate\Database\Seeder;

class ProviderSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'provider' => 'DISH NETWORK', 'created_by_id' => null, 'created_by_team_id' => null,],
            ['id' => 2, 'provider' => 'DirectTV', 'created_by_id' => null, 'created_by_team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\Provider::create($item);
        }
    }
}
