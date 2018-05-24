<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProviderTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateProvider()
    {
        $admin = \App\User::find(1);
        $provider = factory('App\Provider')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $provider) {
            $browser->loginAs($admin)
                ->visit(route('admin.providers.index'))
                ->clickLink('Add new')
                ->type("provider", $provider->provider)
                ->select("network_affiliate_id", $provider->network_affiliate_id)
                ->press('Save')
                ->assertRouteIs('admin.providers.index')
                ->assertSeeIn("tr:last-child td[field-key='provider']", $provider->provider)
                ->assertSeeIn("tr:last-child td[field-key='network_affiliate']", $provider->network_affiliate->network_affiliate);
        });
    }

    public function testEditProvider()
    {
        $admin = \App\User::find(1);
        $provider = factory('App\Provider')->create();
        $provider2 = factory('App\Provider')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $provider, $provider2) {
            $browser->loginAs($admin)
                ->visit(route('admin.providers.index'))
                ->click('tr[data-entry-id="' . $provider->id . '"] .btn-info')
                ->type("provider", $provider2->provider)
                ->select("network_affiliate_id", $provider2->network_affiliate_id)
                ->press('Update')
                ->assertRouteIs('admin.providers.index')
                ->assertSeeIn("tr:last-child td[field-key='provider']", $provider2->provider)
                ->assertSeeIn("tr:last-child td[field-key='network_affiliate']", $provider2->network_affiliate->network_affiliate);
        });
    }

    public function testShowProvider()
    {
        $admin = \App\User::find(1);
        $provider = factory('App\Provider')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $provider) {
            $browser->loginAs($admin)
                ->visit(route('admin.providers.index'))
                ->click('tr[data-entry-id="' . $provider->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='provider']", $provider->provider)
                ->assertSeeIn("td[field-key='network_affiliate']", $provider->network_affiliate->network_affiliate);
        });
    }

}
