<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientStatusTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClientStatus()
    {
        $admin = \App\User::find(1);
        $client_status = factory('App\ClientStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_statuses.index'))
                ->clickLink('Add new')
                ->type("title", $client_status->title)
                ->press('Save')
                ->assertRouteIs('admin.client_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_status->title);
        });
    }

    public function testEditClientStatus()
    {
        $admin = \App\User::find(1);
        $client_status = factory('App\ClientStatus')->create();
        $client_status2 = factory('App\ClientStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_status, $client_status2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_statuses.index'))
                ->click('tr[data-entry-id="' . $client_status->id . '"] .btn-info')
                ->type("title", $client_status2->title)
                ->press('Update')
                ->assertRouteIs('admin.client_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_status2->title);
        });
    }

    public function testShowClientStatus()
    {
        $admin = \App\User::find(1);
        $client_status = factory('App\ClientStatus')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_statuses.index'))
                ->click('tr[data-entry-id="' . $client_status->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $client_status->title);
        });
    }

}
