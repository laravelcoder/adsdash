<?php

use Illuminate\Database\Seeder;

class AgentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'company_id' => 1, 'first_name' => 'first_name', 'last_name' => 'last_name', 'phone1' => '1234567890', 'phone2' => '1234567890', 'email' => 'example@example.com', 'skype' => 'skype', 'address' => 'address', 'photo' => null, 'about' => '<h2>Lorem ipsum dolor sit amet</h2>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
', 'created_by_team_id' => null,],

        ];

        foreach ($items as $item) {
            \App\Agent::create($item);
        }
    }
}
