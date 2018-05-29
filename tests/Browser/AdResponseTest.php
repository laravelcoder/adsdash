<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdResponseTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAdResponse()
    {
        $admin = \App\User::find(1);
        $ad_response = factory('App\AdResponse')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $ad_response) {
            $browser->loginAs($admin)
                ->visit(route('admin.ad_responses.index'))
                ->clickLink('Add new')
                ->select("station_id", $ad_response->station_id)
                ->type("time", $ad_response->time)
                ->type("impressions", $ad_response->impressions)
                ->type("non_impressions", $ad_response->non_impressions)
                ->type("cypi_id", $ad_response->cypi_id)
                ->press('Save')
                ->assertRouteIs('admin.ad_responses.index')
                ->assertSeeIn("tr:last-child td[field-key='time']", $ad_response->time)
                ->assertSeeIn("tr:last-child td[field-key='impressions']", $ad_response->impressions)
                ->assertSeeIn("tr:last-child td[field-key='non_impressions']", $ad_response->non_impressions)
                ->assertSeeIn("tr:last-child td[field-key='cypi_id']", $ad_response->cypi_id);
        });
    }

    public function testEditAdResponse()
    {
        $admin = \App\User::find(1);
        $ad_response = factory('App\AdResponse')->create();
        $ad_response2 = factory('App\AdResponse')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $ad_response, $ad_response2) {
            $browser->loginAs($admin)
                ->visit(route('admin.ad_responses.index'))
                ->click('tr[data-entry-id="' . $ad_response->id . '"] .btn-info')
                ->select("station_id", $ad_response2->station_id)
                ->type("time", $ad_response2->time)
                ->type("impressions", $ad_response2->impressions)
                ->type("non_impressions", $ad_response2->non_impressions)
                ->type("cypi_id", $ad_response2->cypi_id)
                ->press('Update')
                ->assertRouteIs('admin.ad_responses.index')
                ->assertSeeIn("tr:last-child td[field-key='time']", $ad_response2->time)
                ->assertSeeIn("tr:last-child td[field-key='impressions']", $ad_response2->impressions)
                ->assertSeeIn("tr:last-child td[field-key='non_impressions']", $ad_response2->non_impressions)
                ->assertSeeIn("tr:last-child td[field-key='cypi_id']", $ad_response2->cypi_id);
        });
    }

    public function testShowAdResponse()
    {
        $admin = \App\User::find(1);
        $ad_response = factory('App\AdResponse')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $ad_response) {
            $browser->loginAs($admin)
                ->visit(route('admin.ad_responses.index'))
                ->click('tr[data-entry-id="' . $ad_response->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='station']", $ad_response->station->station_label)
                ->assertSeeIn("td[field-key='time']", $ad_response->time)
                ->assertSeeIn("td[field-key='impressions']", $ad_response->impressions)
                ->assertSeeIn("td[field-key='non_impressions']", $ad_response->non_impressions)
                ->assertSeeIn("td[field-key='cypi_id']", $ad_response->cypi_id);
        });
    }

}
