<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AssetsLocationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAssetsLocation()
    {
        $admin = \App\User::find(1);
        $assets_location = factory('App\AssetsLocation')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $assets_location) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets_locations.index'))
                ->clickLink('Add new')
                ->type("title", $assets_location->title)
                ->press('Save')
                ->assertRouteIs('admin.assets_locations.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $assets_location->title);
        });
    }

    public function testEditAssetsLocation()
    {
        $admin = \App\User::find(1);
        $assets_location = factory('App\AssetsLocation')->create();
        $assets_location2 = factory('App\AssetsLocation')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $assets_location, $assets_location2) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets_locations.index'))
                ->click('tr[data-entry-id="' . $assets_location->id . '"] .btn-info')
                ->type("title", $assets_location2->title)
                ->press('Update')
                ->assertRouteIs('admin.assets_locations.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $assets_location2->title);
        });
    }

    public function testShowAssetsLocation()
    {
        $admin = \App\User::find(1);
        $assets_location = factory('App\AssetsLocation')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $assets_location) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets_locations.index'))
                ->click('tr[data-entry-id="' . $assets_location->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $assets_location->title);
        });
    }

}
