<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientDocumentTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClientDocument()
    {
        $admin = \App\User::find(1);
        $client_document = factory('App\ClientDocument')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_document) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_documents.index'))
                ->clickLink('Add new')
                ->select("project_id", $client_document->project_id)
                ->type("title", $client_document->title)
                ->type("description", $client_document->description)
                ->attach("file", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.client_documents.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $client_document->project->title)
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_document->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $client_document->description)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\ClientDocument::first()->file . "']");
        });
    }

    public function testEditClientDocument()
    {
        $admin = \App\User::find(1);
        $client_document = factory('App\ClientDocument')->create();
        $client_document2 = factory('App\ClientDocument')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_document, $client_document2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_documents.index'))
                ->click('tr[data-entry-id="' . $client_document->id . '"] .btn-info')
                ->select("project_id", $client_document2->project_id)
                ->type("title", $client_document2->title)
                ->type("description", $client_document2->description)
                ->attach("file", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.client_documents.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $client_document2->project->title)
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_document2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $client_document2->description)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\ClientDocument::first()->file . "']");
        });
    }

    public function testShowClientDocument()
    {
        $admin = \App\User::find(1);
        $client_document = factory('App\ClientDocument')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_document) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_documents.index'))
                ->click('tr[data-entry-id="' . $client_document->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project']", $client_document->project->title)
                ->assertSeeIn("td[field-key='title']", $client_document->title)
                ->assertSeeIn("td[field-key='description']", $client_document->description);
        });
    }

}
