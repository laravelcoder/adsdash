<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserBaseTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateUserBase()
    {
        $admin = \App\User::find(1);
        $user_base = factory('App\UserBase')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $user_base) {
            $browser->loginAs($admin)
                ->visit(route('admin.user_bases.index'))
                ->clickLink('Add new')
                ->type("name", $user_base->name)
                ->type("value", $user_base->value)
                ->press('Save')
                ->assertRouteIs('admin.user_bases.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user_base->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $user_base->value);
        });
    }

    public function testEditUserBase()
    {
        $admin = \App\User::find(1);
        $user_base = factory('App\UserBase')->create();
        $user_base2 = factory('App\UserBase')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $user_base, $user_base2) {
            $browser->loginAs($admin)
                ->visit(route('admin.user_bases.index'))
                ->click('tr[data-entry-id="' . $user_base->id . '"] .btn-info')
                ->type("name", $user_base2->name)
                ->type("value", $user_base2->value)
                ->press('Update')
                ->assertRouteIs('admin.user_bases.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user_base2->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $user_base2->value);
        });
    }

    public function testShowUserBase()
    {
        $admin = \App\User::find(1);
        $user_base = factory('App\UserBase')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $user_base) {
            $browser->loginAs($admin)
                ->visit(route('admin.user_bases.index'))
                ->click('tr[data-entry-id="' . $user_base->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $user_base->name)
                ->assertSeeIn("td[field-key='value']", $user_base->value)
                ->assertSeeIn("td[field-key='created_by']", $user_base->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $user_base->created_by_team->name);
        });
    }

}
