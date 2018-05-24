<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 2, 'name' => 'Phillip Madsen', 'email' => 'wecodelaravel@gmail.com', 'password' => '$2y$10$miU..02OVw.Al9CsIydebemCp6qjycn0yFvjzU050Z0FPFpo1UKWu', 'remember_token' => null, 'team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
