<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class StationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateStation()
    {
        $admin = \App\User::find(1);
        $station = factory('App\Station')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $station) {
            $browser->loginAs($admin)
                ->visit(route('admin.stations.index'))
                ->clickLink('Add new')
                ->type("station_label", $station->station_label)
                ->type("channel_number", $station->channel_number)
                ->select("provider_id", $station->provider_id)
                ->press('Save')
                ->assertRouteIs('admin.stations.index')
                ->assertSeeIn("tr:last-child td[field-key='station_label']", $station->station_label)
                ->assertSeeIn("tr:last-child td[field-key='channel_number']", $station->channel_number)
                ->assertSeeIn("tr:last-child td[field-key='provider']", $station->provider->provider);
        });
    }

    public function testEditStation()
    {
        $admin = \App\User::find(1);
        $station = factory('App\Station')->create();
        $station2 = factory('App\Station')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $station, $station2) {
            $browser->loginAs($admin)
                ->visit(route('admin.stations.index'))
                ->click('tr[data-entry-id="' . $station->id . '"] .btn-info')
                ->type("station_label", $station2->station_label)
                ->type("channel_number", $station2->channel_number)
                ->select("provider_id", $station2->provider_id)
                ->press('Update')
                ->assertRouteIs('admin.stations.index')
                ->assertSeeIn("tr:last-child td[field-key='station_label']", $station2->station_label)
                ->assertSeeIn("tr:last-child td[field-key='channel_number']", $station2->channel_number)
                ->assertSeeIn("tr:last-child td[field-key='provider']", $station2->provider->provider);
        });
    }

    public function testShowStation()
    {
        $admin = \App\User::find(1);
        $station = factory('App\Station')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $station) {
            $browser->loginAs($admin)
                ->visit(route('admin.stations.index'))
                ->click('tr[data-entry-id="' . $station->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='station_label']", $station->station_label)
                ->assertSeeIn("td[field-key='channel_number']", $station->channel_number)
                ->assertSeeIn("td[field-key='provider']", $station->provider->provider);
        });
    }

}
