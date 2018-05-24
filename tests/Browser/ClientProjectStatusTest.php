<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientProjectStatusTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClientProjectStatus()
    {
        $admin = \App\User::find(1);
        $client_project_status = factory('App\ClientProjectStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_project_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_project_statuses.index'))
                ->clickLink('Add new')
                ->type("title", $client_project_status->title)
                ->press('Save')
                ->assertRouteIs('admin.client_project_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_project_status->title);
        });
    }

    public function testEditClientProjectStatus()
    {
        $admin = \App\User::find(1);
        $client_project_status = factory('App\ClientProjectStatus')->create();
        $client_project_status2 = factory('App\ClientProjectStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_project_status, $client_project_status2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_project_statuses.index'))
                ->click('tr[data-entry-id="' . $client_project_status->id . '"] .btn-info')
                ->type("title", $client_project_status2->title)
                ->press('Update')
                ->assertRouteIs('admin.client_project_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_project_status2->title);
        });
    }

    public function testShowClientProjectStatus()
    {
        $admin = \App\User::find(1);
        $client_project_status = factory('App\ClientProjectStatus')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_project_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_project_statuses.index'))
                ->click('tr[data-entry-id="' . $client_project_status->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $client_project_status->title);
        });
    }

}
