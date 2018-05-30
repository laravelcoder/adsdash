<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAd()
    {
        $admin = \App\User::find(1);
        $ad = factory('App\Ad')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $ad) {
            $browser->loginAs($admin)
                ->visit(route('admin.ads.index'))
                ->clickLink('Add new')
                ->type("ad_label", $ad->ad_label)
                ->type("ad_description", $ad->ad_description)
                ->type("total_impressions", $ad->total_impressions)
                ->type("total_networks", $ad->total_networks)
                ->type("total_channels", $ad->total_channels)
                ->press('Save')
                ->assertRouteIs('admin.ads.index')
                ->assertSeeIn("tr:last-child td[field-key='ad_label']", $ad->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='total_impressions']", $ad->total_impressions)
                ->assertSeeIn("tr:last-child td[field-key='total_networks']", $ad->total_networks)
                ->assertSeeIn("tr:last-child td[field-key='total_channels']", $ad->total_channels);
        });
    }

    public function testEditAd()
    {
        $admin = \App\User::find(1);
        $ad = factory('App\Ad')->create();
        $ad2 = factory('App\Ad')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $ad, $ad2) {
            $browser->loginAs($admin)
                ->visit(route('admin.ads.index'))
                ->click('tr[data-entry-id="' . $ad->id . '"] .btn-info')
                ->type("ad_label", $ad2->ad_label)
                ->type("ad_description", $ad2->ad_description)
                ->type("total_impressions", $ad2->total_impressions)
                ->type("total_networks", $ad2->total_networks)
                ->type("total_channels", $ad2->total_channels)
                ->press('Update')
                ->assertRouteIs('admin.ads.index')
                ->assertSeeIn("tr:last-child td[field-key='ad_label']", $ad2->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='total_impressions']", $ad2->total_impressions)
                ->assertSeeIn("tr:last-child td[field-key='total_networks']", $ad2->total_networks)
                ->assertSeeIn("tr:last-child td[field-key='total_channels']", $ad2->total_channels);
        });
    }

    public function testShowAd()
    {
        $admin = \App\User::find(1);
        $ad = factory('App\Ad')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $ad) {
            $browser->loginAs($admin)
                ->visit(route('admin.ads.index'))
                ->click('tr[data-entry-id="' . $ad->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='ad_label']", $ad->ad_label)
                ->assertSeeIn("td[field-key='ad_description']", $ad->ad_description)
                ->assertSeeIn("td[field-key='total_impressions']", $ad->total_impressions)
                ->assertSeeIn("td[field-key='total_networks']", $ad->total_networks)
                ->assertSeeIn("td[field-key='total_channels']", $ad->total_channels);
        });
    }

}
