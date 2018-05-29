<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VariableTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateVariable()
    {
        $admin = \App\User::find(1);
        $variable = factory('App\Variable')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $variable) {
            $browser->loginAs($admin)
                ->visit(route('admin.variables.index'))
                ->clickLink('Add new')
                ->type("name", $variable->name)
                ->type("value", $variable->value)
                ->press('Save')
                ->assertRouteIs('admin.variables.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $variable->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $variable->value);
        });
    }

    public function testEditVariable()
    {
        $admin = \App\User::find(1);
        $variable = factory('App\Variable')->create();
        $variable2 = factory('App\Variable')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $variable, $variable2) {
            $browser->loginAs($admin)
                ->visit(route('admin.variables.index'))
                ->click('tr[data-entry-id="' . $variable->id . '"] .btn-info')
                ->type("name", $variable2->name)
                ->type("value", $variable2->value)
                ->press('Update')
                ->assertRouteIs('admin.variables.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $variable2->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $variable2->value);
        });
    }

    public function testShowVariable()
    {
        $admin = \App\User::find(1);
        $variable = factory('App\Variable')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $variable) {
            $browser->loginAs($admin)
                ->visit(route('admin.variables.index'))
                ->click('tr[data-entry-id="' . $variable->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $variable->name)
                ->assertSeeIn("td[field-key='value']", $variable->value);
        });
    }

}
