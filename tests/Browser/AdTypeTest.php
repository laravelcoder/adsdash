<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AdTypeTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAdType()
    {
        $admin = \App\User::find(1);
        $ad_type = factory('App\AdType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $ad_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.ad_types.index'))
                ->clickLink('Add new')
                ->type("codec", $ad_type->codec)
                ->type("extention", $ad_type->extention)
                ->press('Save')
                ->assertRouteIs('admin.ad_types.index')
                ->assertSeeIn("tr:last-child td[field-key='codec']", $ad_type->codec)
                ->assertSeeIn("tr:last-child td[field-key='extention']", $ad_type->extention);
        });
    }

    public function testEditAdType()
    {
        $admin = \App\User::find(1);
        $ad_type = factory('App\AdType')->create();
        $ad_type2 = factory('App\AdType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $ad_type, $ad_type2) {
            $browser->loginAs($admin)
                ->visit(route('admin.ad_types.index'))
                ->click('tr[data-entry-id="' . $ad_type->id . '"] .btn-info')
                ->type("codec", $ad_type2->codec)
                ->type("extention", $ad_type2->extention)
                ->press('Update')
                ->assertRouteIs('admin.ad_types.index')
                ->assertSeeIn("tr:last-child td[field-key='codec']", $ad_type2->codec)
                ->assertSeeIn("tr:last-child td[field-key='extention']", $ad_type2->extention);
        });
    }

    public function testShowAdType()
    {
        $admin = \App\User::find(1);
        $ad_type = factory('App\AdType')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $ad_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.ad_types.index'))
                ->click('tr[data-entry-id="' . $ad_type->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='codec']", $ad_type->codec)
                ->assertSeeIn("td[field-key='extention']", $ad_type->extention);
        });
    }

}
