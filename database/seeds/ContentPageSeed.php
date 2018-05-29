<?php

use Illuminate\Database\Seeder;

class ContentPageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'About us', 'page_text' => 'Sample text', 'excerpt' => 'Sample excerpt', 'featured_image' => '',],
            ['id' => 2, 'title' => 'BASIC EXAMPLE', 'page_text' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
', 'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'featured_image' => null,],

        ];

        foreach ($items as $item) {
            \App\ContentPage::create($item);
        }
    }
}
