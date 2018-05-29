<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class StylesheetTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateStylesheet()
    {
        $admin = \App\User::find(1);
        $stylesheet = factory('App\Stylesheet')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $stylesheet) {
            $browser->loginAs($admin)
                ->visit(route('admin.stylesheets.index'))
                ->clickLink('Add new')
                ->type("link", $stylesheet->link)
                ->select("template_id", $stylesheet->template_id)
                ->press('Save')
                ->assertRouteIs('admin.stylesheets.index')
                ->assertSeeIn("tr:last-child td[field-key='link']", $stylesheet->link)
                ->assertSeeIn("tr:last-child td[field-key='template']", $stylesheet->template->template_name);
        });
    }

    public function testEditStylesheet()
    {
        $admin = \App\User::find(1);
        $stylesheet = factory('App\Stylesheet')->create();
        $stylesheet2 = factory('App\Stylesheet')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $stylesheet, $stylesheet2) {
            $browser->loginAs($admin)
                ->visit(route('admin.stylesheets.index'))
                ->click('tr[data-entry-id="' . $stylesheet->id . '"] .btn-info')
                ->type("link", $stylesheet2->link)
                ->select("template_id", $stylesheet2->template_id)
                ->press('Update')
                ->assertRouteIs('admin.stylesheets.index')
                ->assertSeeIn("tr:last-child td[field-key='link']", $stylesheet2->link)
                ->assertSeeIn("tr:last-child td[field-key='template']", $stylesheet2->template->template_name);
        });
    }

    public function testShowStylesheet()
    {
        $admin = \App\User::find(1);
        $stylesheet = factory('App\Stylesheet')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $stylesheet) {
            $browser->loginAs($admin)
                ->visit(route('admin.stylesheets.index'))
                ->click('tr[data-entry-id="' . $stylesheet->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='link']", $stylesheet->link)
                ->assertSeeIn("td[field-key='template']", $stylesheet->template->template_name);
        });
    }

}
