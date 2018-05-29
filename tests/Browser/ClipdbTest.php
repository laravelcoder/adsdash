<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClipdbTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClipdb()
    {
        $admin = \App\User::find(1);
        $clipdb = factory('App\Clipdb')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $clipdb) {
            $browser->loginAs($admin)
                ->visit(route('admin.clipdbs.index'))
                ->clickLink('Add new')
                ->type("clip_label", $clipdb->clip_label)
                ->press('Save')
                ->assertRouteIs('admin.clipdbs.index')
                ->assertSeeIn("tr:last-child td[field-key='clip_label']", $clipdb->clip_label);
        });
    }

    public function testEditClipdb()
    {
        $admin = \App\User::find(1);
        $clipdb = factory('App\Clipdb')->create();
        $clipdb2 = factory('App\Clipdb')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $clipdb, $clipdb2) {
            $browser->loginAs($admin)
                ->visit(route('admin.clipdbs.index'))
                ->click('tr[data-entry-id="' . $clipdb->id . '"] .btn-info')
                ->type("clip_label", $clipdb2->clip_label)
                ->press('Update')
                ->assertRouteIs('admin.clipdbs.index')
                ->assertSeeIn("tr:last-child td[field-key='clip_label']", $clipdb2->clip_label);
        });
    }

    public function testShowClipdb()
    {
        $admin = \App\User::find(1);
        $clipdb = factory('App\Clipdb')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $clipdb) {
            $browser->loginAs($admin)
                ->visit(route('admin.clipdbs.index'))
                ->click('tr[data-entry-id="' . $clipdb->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='clip_label']", $clipdb->clip_label)
                ->assertSeeIn("td[field-key='created_by']", $clipdb->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $clipdb->created_by_team->name);
        });
    }

}
