<?php

use Illuminate\Database\Seeder;

class PhoneSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'phone_number' => '555 555 5555', 'contact_id' => 1, 'agent_id' => null, 'company_id' => null,],
            ['id' => 2, 'phone_number' => '800 555 5555', 'contact_id' => 1, 'agent_id' => null, 'company_id' => null,],
            ['id' => 3, 'phone_number' => '555 555 5555', 'contact_id' => null, 'agent_id' => 1, 'company_id' => null,],
            ['id' => 4, 'phone_number' => '800 555 5555', 'contact_id' => null, 'agent_id' => 1, 'company_id' => null,],
            ['id' => 5, 'phone_number' => '555 555 5555', 'contact_id' => null, 'agent_id' => null, 'company_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Phone::create($item);
        }
    }
}
