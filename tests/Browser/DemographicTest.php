<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DemographicTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateDemographic()
    {
        $admin = \App\User::find(1);
        $demographic = factory('App\Demographic')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $demographic) {
            $browser->loginAs($admin)
                ->visit(route('admin.demographics.index'))
                ->clickLink('Add new')
                ->type("demographic", $demographic->demographic)
                ->type("value", $demographic->value)
                ->select("audience_id", $demographic->audience_id)
                ->press('Save')
                ->assertRouteIs('admin.demographics.index')
                ->assertSeeIn("tr:last-child td[field-key='demographic']", $demographic->demographic)
                ->assertSeeIn("tr:last-child td[field-key='value']", $demographic->value)
                ->assertSeeIn("tr:last-child td[field-key='audience']", $demographic->audience->name);
        });
    }

    public function testEditDemographic()
    {
        $admin = \App\User::find(1);
        $demographic = factory('App\Demographic')->create();
        $demographic2 = factory('App\Demographic')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $demographic, $demographic2) {
            $browser->loginAs($admin)
                ->visit(route('admin.demographics.index'))
                ->click('tr[data-entry-id="' . $demographic->id . '"] .btn-info')
                ->type("demographic", $demographic2->demographic)
                ->type("value", $demographic2->value)
                ->select("audience_id", $demographic2->audience_id)
                ->press('Update')
                ->assertRouteIs('admin.demographics.index')
                ->assertSeeIn("tr:last-child td[field-key='demographic']", $demographic2->demographic)
                ->assertSeeIn("tr:last-child td[field-key='value']", $demographic2->value)
                ->assertSeeIn("tr:last-child td[field-key='audience']", $demographic2->audience->name);
        });
    }

    public function testShowDemographic()
    {
        $admin = \App\User::find(1);
        $demographic = factory('App\Demographic')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $demographic) {
            $browser->loginAs($admin)
                ->visit(route('admin.demographics.index'))
                ->click('tr[data-entry-id="' . $demographic->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='demographic']", $demographic->demographic)
                ->assertSeeIn("td[field-key='value']", $demographic->value)
                ->assertSeeIn("td[field-key='audience']", $demographic->audience->name);
        });
    }

}
