<?php

use Illuminate\Database\Seeder;

class ClipdbSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'clip_label' => 'test clip', 'created_by_id' => 2, 'created_by_team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\Clipdb::create($item);
        }
    }
}
