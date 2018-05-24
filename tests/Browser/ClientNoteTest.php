<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientNoteTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClientNote()
    {
        $admin = \App\User::find(1);
        $client_note = factory('App\ClientNote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_note) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_notes.index'))
                ->clickLink('Add new')
                ->select("project_id", $client_note->project_id)
                ->type("text", $client_note->text)
                ->press('Save')
                ->assertRouteIs('admin.client_notes.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $client_note->project->title)
                ->assertSeeIn("tr:last-child td[field-key='text']", $client_note->text);
        });
    }

    public function testEditClientNote()
    {
        $admin = \App\User::find(1);
        $client_note = factory('App\ClientNote')->create();
        $client_note2 = factory('App\ClientNote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_note, $client_note2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_notes.index'))
                ->click('tr[data-entry-id="' . $client_note->id . '"] .btn-info')
                ->select("project_id", $client_note2->project_id)
                ->type("text", $client_note2->text)
                ->press('Update')
                ->assertRouteIs('admin.client_notes.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $client_note2->project->title)
                ->assertSeeIn("tr:last-child td[field-key='text']", $client_note2->text);
        });
    }

    public function testShowClientNote()
    {
        $admin = \App\User::find(1);
        $client_note = factory('App\ClientNote')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_note) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_notes.index'))
                ->click('tr[data-entry-id="' . $client_note->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project']", $client_note->project->title)
                ->assertSeeIn("td[field-key='text']", $client_note->text);
        });
    }

}
