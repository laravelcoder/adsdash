<?php

use Illuminate\Database\Seeder;

class BottomScriptSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            1 => [
                'pages' => [],
            ],
            2 => [
                'pages' => [],
            ],
            3 => [
                'pages' => [],
            ],
            4 => [
                'pages' => [],
            ],
            5 => [
                'pages' => [],
            ],
            6 => [
                'pages' => [],
            ],
            7 => [
                'pages' => [1, 2, 3],
            ],
            8 => [
                'pages' => [],
            ],
            9 => [
                'pages' => [],
            ],

        ];

        foreach ($items as $id => $item) {
            $bottomScript = \App\BottomScript::find($id);

            foreach ($item as $key => $ids) {
                $bottomScript->{$key}()->sync($ids);
            }
        }
    }
}
