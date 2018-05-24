<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientProjectTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClientProject()
    {
        $admin = \App\User::find(1);
        $client_project = factory('App\ClientProject')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_project) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_projects.index'))
                ->clickLink('Add new')
                ->type("title", $client_project->title)
                ->select("client_id", $client_project->client_id)
                ->type("description", $client_project->description)
                ->type("date", $client_project->date)
                ->type("budget", $client_project->budget)
                ->select("project_status_id", $client_project->project_status_id)
                ->press('Save')
                ->assertRouteIs('admin.client_projects.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_project->title)
                ->assertSeeIn("tr:last-child td[field-key='client']", $client_project->client->first_name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $client_project->description)
                ->assertSeeIn("tr:last-child td[field-key='date']", $client_project->date)
                ->assertSeeIn("tr:last-child td[field-key='budget']", $client_project->budget)
                ->assertSeeIn("tr:last-child td[field-key='project_status']", $client_project->project_status->title);
        });
    }

    public function testEditClientProject()
    {
        $admin = \App\User::find(1);
        $client_project = factory('App\ClientProject')->create();
        $client_project2 = factory('App\ClientProject')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_project, $client_project2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_projects.index'))
                ->click('tr[data-entry-id="' . $client_project->id . '"] .btn-info')
                ->type("title", $client_project2->title)
                ->select("client_id", $client_project2->client_id)
                ->type("description", $client_project2->description)
                ->type("date", $client_project2->date)
                ->type("budget", $client_project2->budget)
                ->select("project_status_id", $client_project2->project_status_id)
                ->press('Update')
                ->assertRouteIs('admin.client_projects.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_project2->title)
                ->assertSeeIn("tr:last-child td[field-key='client']", $client_project2->client->first_name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $client_project2->description)
                ->assertSeeIn("tr:last-child td[field-key='date']", $client_project2->date)
                ->assertSeeIn("tr:last-child td[field-key='budget']", $client_project2->budget)
                ->assertSeeIn("tr:last-child td[field-key='project_status']", $client_project2->project_status->title);
        });
    }

    public function testShowClientProject()
    {
        $admin = \App\User::find(1);
        $client_project = factory('App\ClientProject')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_project) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_projects.index'))
                ->click('tr[data-entry-id="' . $client_project->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $client_project->title)
                ->assertSeeIn("td[field-key='client']", $client_project->client->first_name)
                ->assertSeeIn("td[field-key='description']", $client_project->description)
                ->assertSeeIn("td[field-key='date']", $client_project->date)
                ->assertSeeIn("td[field-key='budget']", $client_project->budget)
                ->assertSeeIn("td[field-key='project_status']", $client_project->project_status->title);
        });
    }

}
