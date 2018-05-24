<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AudienceTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAudience()
    {
        $admin = \App\User::find(1);
        $audience = factory('App\Audience')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $audience) {
            $browser->loginAs($admin)
                ->visit(route('admin.audiences.index'))
                ->clickLink('Add new')
                ->type("name", $audience->name)
                ->type("value", $audience->value)
                ->press('Save')
                ->assertRouteIs('admin.audiences.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $audience->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $audience->value);
        });
    }

    public function testEditAudience()
    {
        $admin = \App\User::find(1);
        $audience = factory('App\Audience')->create();
        $audience2 = factory('App\Audience')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $audience, $audience2) {
            $browser->loginAs($admin)
                ->visit(route('admin.audiences.index'))
                ->click('tr[data-entry-id="' . $audience->id . '"] .btn-info')
                ->type("name", $audience2->name)
                ->type("value", $audience2->value)
                ->press('Update')
                ->assertRouteIs('admin.audiences.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $audience2->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $audience2->value);
        });
    }

    public function testShowAudience()
    {
        $admin = \App\User::find(1);
        $audience = factory('App\Audience')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $audience) {
            $browser->loginAs($admin)
                ->visit(route('admin.audiences.index'))
                ->click('tr[data-entry-id="' . $audience->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $audience->name)
                ->assertSeeIn("td[field-key='value']", $audience->value)
                ->assertSeeIn("td[field-key='created_by']", $audience->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $audience->created_by_team->name);
        });
    }

}
