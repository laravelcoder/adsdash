<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientIncomeSourceTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClientIncomeSource()
    {
        $admin = \App\User::find(1);
        $client_income_source = factory('App\ClientIncomeSource')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_income_source) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_income_sources.index'))
                ->clickLink('Add new')
                ->type("title", $client_income_source->title)
                ->type("fee_percent", $client_income_source->fee_percent)
                ->press('Save')
                ->assertRouteIs('admin.client_income_sources.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_income_source->title)
                ->assertSeeIn("tr:last-child td[field-key='fee_percent']", $client_income_source->fee_percent);
        });
    }

    public function testEditClientIncomeSource()
    {
        $admin = \App\User::find(1);
        $client_income_source = factory('App\ClientIncomeSource')->create();
        $client_income_source2 = factory('App\ClientIncomeSource')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_income_source, $client_income_source2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_income_sources.index'))
                ->click('tr[data-entry-id="' . $client_income_source->id . '"] .btn-info')
                ->type("title", $client_income_source2->title)
                ->type("fee_percent", $client_income_source2->fee_percent)
                ->press('Update')
                ->assertRouteIs('admin.client_income_sources.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_income_source2->title)
                ->assertSeeIn("tr:last-child td[field-key='fee_percent']", $client_income_source2->fee_percent);
        });
    }

    public function testShowClientIncomeSource()
    {
        $admin = \App\User::find(1);
        $client_income_source = factory('App\ClientIncomeSource')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_income_source) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_income_sources.index'))
                ->click('tr[data-entry-id="' . $client_income_source->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $client_income_source->title)
                ->assertSeeIn("td[field-key='fee_percent']", $client_income_source->fee_percent);
        });
    }

}
