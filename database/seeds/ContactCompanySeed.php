<?php

use Illuminate\Database\Seeder;

class ContactCompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Coke', 'website' => 'www.coke.com', 'email' => 'coke@any.com', 'logo' => null, 'address' => 'test address', 'city' => null, 'state' => null, 'zipcode' => null,],

        ];

        foreach ($items as $item) {
            \App\ContactCompany::create($item);
        }
    }
}
