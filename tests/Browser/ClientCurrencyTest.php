<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientCurrencyTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClientCurrency()
    {
        $admin = \App\User::find(1);
        $client_currency = factory('App\ClientCurrency')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_currency) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_currencies.index'))
                ->clickLink('Add new')
                ->type("title", $client_currency->title)
                ->type("code", $client_currency->code)
                ->check("main_currency")
                ->press('Save')
                ->assertRouteIs('admin.client_currencies.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_currency->title)
                ->assertSeeIn("tr:last-child td[field-key='code']", $client_currency->code)
                ->assertChecked("main_currency");
        });
    }

    public function testEditClientCurrency()
    {
        $admin = \App\User::find(1);
        $client_currency = factory('App\ClientCurrency')->create();
        $client_currency2 = factory('App\ClientCurrency')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_currency, $client_currency2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_currencies.index'))
                ->click('tr[data-entry-id="' . $client_currency->id . '"] .btn-info')
                ->type("title", $client_currency2->title)
                ->type("code", $client_currency2->code)
                ->check("main_currency")
                ->press('Update')
                ->assertRouteIs('admin.client_currencies.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_currency2->title)
                ->assertSeeIn("tr:last-child td[field-key='code']", $client_currency2->code)
                ->assertChecked("main_currency");
        });
    }

    public function testShowClientCurrency()
    {
        $admin = \App\User::find(1);
        $client_currency = factory('App\ClientCurrency')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_currency) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_currencies.index'))
                ->click('tr[data-entry-id="' . $client_currency->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $client_currency->title)
                ->assertSeeIn("td[field-key='code']", $client_currency->code)
                ->assertNotChecked("main_currency");
        });
    }

}
