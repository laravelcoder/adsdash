<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClient()
    {
        $admin = \App\User::find(1);
        $client = factory('App\Client')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client) {
            $browser->loginAs($admin)
                ->visit(route('admin.clients.index'))
                ->clickLink('Add new')
                ->type("first_name", $client->first_name)
                ->type("last_name", $client->last_name)
                ->type("company_name", $client->company_name)
                ->type("email", $client->email)
                ->type("phone", $client->phone)
                ->type("website", $client->website)
                ->type("skype", $client->skype)
                ->type("country", $client->country)
                ->select("client_status_id", $client->client_status_id)
                ->press('Save')
                ->assertRouteIs('admin.clients.index')
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $client->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $client->last_name)
                ->assertSeeIn("tr:last-child td[field-key='company_name']", $client->company_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $client->email)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $client->phone)
                ->assertSeeIn("tr:last-child td[field-key='website']", $client->website)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $client->skype)
                ->assertSeeIn("tr:last-child td[field-key='country']", $client->country)
                ->assertSeeIn("tr:last-child td[field-key='client_status']", $client->client_status->title);
        });
    }

    public function testEditClient()
    {
        $admin = \App\User::find(1);
        $client = factory('App\Client')->create();
        $client2 = factory('App\Client')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client, $client2) {
            $browser->loginAs($admin)
                ->visit(route('admin.clients.index'))
                ->click('tr[data-entry-id="' . $client->id . '"] .btn-info')
                ->type("first_name", $client2->first_name)
                ->type("last_name", $client2->last_name)
                ->type("company_name", $client2->company_name)
                ->type("email", $client2->email)
                ->type("phone", $client2->phone)
                ->type("website", $client2->website)
                ->type("skype", $client2->skype)
                ->type("country", $client2->country)
                ->select("client_status_id", $client2->client_status_id)
                ->press('Update')
                ->assertRouteIs('admin.clients.index')
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $client2->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $client2->last_name)
                ->assertSeeIn("tr:last-child td[field-key='company_name']", $client2->company_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $client2->email)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $client2->phone)
                ->assertSeeIn("tr:last-child td[field-key='website']", $client2->website)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $client2->skype)
                ->assertSeeIn("tr:last-child td[field-key='country']", $client2->country)
                ->assertSeeIn("tr:last-child td[field-key='client_status']", $client2->client_status->title);
        });
    }

    public function testShowClient()
    {
        $admin = \App\User::find(1);
        $client = factory('App\Client')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client) {
            $browser->loginAs($admin)
                ->visit(route('admin.clients.index'))
                ->click('tr[data-entry-id="' . $client->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='first_name']", $client->first_name)
                ->assertSeeIn("td[field-key='last_name']", $client->last_name)
                ->assertSeeIn("td[field-key='company_name']", $client->company_name)
                ->assertSeeIn("td[field-key='email']", $client->email)
                ->assertSeeIn("td[field-key='phone']", $client->phone)
                ->assertSeeIn("td[field-key='website']", $client->website)
                ->assertSeeIn("td[field-key='skype']", $client->skype)
                ->assertSeeIn("td[field-key='country']", $client->country)
                ->assertSeeIn("td[field-key='client_status']", $client->client_status->title);
        });
    }

}
