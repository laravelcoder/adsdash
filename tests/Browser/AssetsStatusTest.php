<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AssetsStatusTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAssetsStatus()
    {
        $admin = \App\User::find(1);
        $assets_status = factory('App\AssetsStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $assets_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets_statuses.index'))
                ->clickLink('Add new')
                ->type("title", $assets_status->title)
                ->press('Save')
                ->assertRouteIs('admin.assets_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $assets_status->title);
        });
    }

    public function testEditAssetsStatus()
    {
        $admin = \App\User::find(1);
        $assets_status = factory('App\AssetsStatus')->create();
        $assets_status2 = factory('App\AssetsStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $assets_status, $assets_status2) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets_statuses.index'))
                ->click('tr[data-entry-id="' . $assets_status->id . '"] .btn-info')
                ->type("title", $assets_status2->title)
                ->press('Update')
                ->assertRouteIs('admin.assets_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $assets_status2->title);
        });
    }

    public function testShowAssetsStatus()
    {
        $admin = \App\User::find(1);
        $assets_status = factory('App\AssetsStatus')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $assets_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets_statuses.index'))
                ->click('tr[data-entry-id="' . $assets_status->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $assets_status->title);
        });
    }

}
