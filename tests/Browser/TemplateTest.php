<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TemplateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateTemplate()
    {
        $admin = \App\User::find(1);
        $template = factory('App\Template')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $template) {
            $browser->loginAs($admin)
                ->visit(route('admin.templates.index'))
                ->clickLink('Add new')
                ->type("template_name", $template->template_name)
                ->type("layout", $template->layout)
                ->type("description", $template->description)
                ->press('Save')
                ->assertRouteIs('admin.templates.index')
                ->assertSeeIn("tr:last-child td[field-key='template_name']", $template->template_name);
        });
    }

    public function testEditTemplate()
    {
        $admin = \App\User::find(1);
        $template = factory('App\Template')->create();
        $template2 = factory('App\Template')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $template, $template2) {
            $browser->loginAs($admin)
                ->visit(route('admin.templates.index'))
                ->click('tr[data-entry-id="' . $template->id . '"] .btn-info')
                ->type("template_name", $template2->template_name)
                ->type("layout", $template2->layout)
                ->type("description", $template2->description)
                ->press('Update')
                ->assertRouteIs('admin.templates.index')
                ->assertSeeIn("tr:last-child td[field-key='template_name']", $template2->template_name);
        });
    }

    public function testShowTemplate()
    {
        $admin = \App\User::find(1);
        $template = factory('App\Template')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $template) {
            $browser->loginAs($admin)
                ->visit(route('admin.templates.index'))
                ->click('tr[data-entry-id="' . $template->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='template_name']", $template->template_name)
                ->assertSeeIn("td[field-key='layout']", $template->layout)
                ->assertSeeIn("td[field-key='description']", $template->description);
        });
    }

}
