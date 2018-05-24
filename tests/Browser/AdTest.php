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
                ->type("link", $ad->link)
                ->type("ad_label", $ad->ad_label)
                ->type("ad_type", $ad->ad_type)
                ->press('Save')
                ->assertRouteIs('admin.ads.index')
                ->assertSeeIn("tr:last-child td[field-key='ad_label']", $ad->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='ad_type']", $ad->ad_type);
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
                ->type("link", $ad2->link)
                ->type("ad_label", $ad2->ad_label)
                ->type("ad_type", $ad2->ad_type)
                ->press('Update')
                ->assertRouteIs('admin.ads.index')
                ->assertSeeIn("tr:last-child td[field-key='ad_label']", $ad2->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='ad_type']", $ad2->ad_type);
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
                ->assertSeeIn("td[field-key='link']", $ad->link)
                ->assertSeeIn("td[field-key='ad_label']", $ad->ad_label)
                ->assertSeeIn("td[field-key='ad_type']", $ad->ad_type)
                ->assertSeeIn("td[field-key='created_by']", $ad->created_by->name);
        });
    }

}
