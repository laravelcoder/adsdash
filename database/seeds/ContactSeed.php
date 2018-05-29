<?php

use Illuminate\Database\Seeder;

class ContactSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'company_id' => 1, 'first_name' => 'test ', 'last_name' => 'employee', 'email' => 'coke1@any.com', 'skype' => null, 'address' => null, 'created_by_id' => 2, 'photo' => null, 'created_by_team_id' => null, 'about' => '<h2>Lorem ipsum dolor sit amet, consectetur adipisicing eli</h2>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
',],

        ];

        foreach ($items as $item) {
            \App\Contact::create($item);
        }
    }
}
