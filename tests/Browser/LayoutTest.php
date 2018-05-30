<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LayoutTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateLayout()
    {
        $admin = \App\User::find(1);
        $layout = factory('App\Layout')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $layout) {
            $browser->loginAs($admin)
                ->visit(route('admin.layouts.index'))
                ->clickLink('Add new')
                ->type("layout", $layout->layout)
                ->type("path", $layout->path)
                ->type("address", $layout->address)
                ->select("template_id", $layout->template_id)
                ->press('Save')
                ->assertRouteIs('admin.layouts.index')
                ->assertSeeIn("tr:last-child td[field-key='layout']", $layout->layout)
                ->assertSeeIn("tr:last-child td[field-key='path']", $layout->path)
                ->assertSeeIn("tr:last-child td[field-key='address']", $layout->address)
                ->assertSeeIn("tr:last-child td[field-key='template']", $layout->template->template_name);
        });
    }

    public function testEditLayout()
    {
        $admin = \App\User::find(1);
        $layout = factory('App\Layout')->create();
        $layout2 = factory('App\Layout')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $layout, $layout2) {
            $browser->loginAs($admin)
                ->visit(route('admin.layouts.index'))
                ->click('tr[data-entry-id="' . $layout->id . '"] .btn-info')
                ->type("layout", $layout2->layout)
                ->type("path", $layout2->path)
                ->type("address", $layout2->address)
                ->select("template_id", $layout2->template_id)
                ->press('Update')
                ->assertRouteIs('admin.layouts.index')
                ->assertSeeIn("tr:last-child td[field-key='layout']", $layout2->layout)
                ->assertSeeIn("tr:last-child td[field-key='path']", $layout2->path)
                ->assertSeeIn("tr:last-child td[field-key='address']", $layout2->address)
                ->assertSeeIn("tr:last-child td[field-key='template']", $layout2->template->template_name);
        });
    }

    public function testShowLayout()
    {
        $admin = \App\User::find(1);
        $layout = factory('App\Layout')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $layout) {
            $browser->loginAs($admin)
                ->visit(route('admin.layouts.index'))
                ->click('tr[data-entry-id="' . $layout->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='layout']", $layout->layout)
                ->assertSeeIn("td[field-key='path']", $layout->path)
                ->assertSeeIn("td[field-key='address']", $layout->address)
                ->assertSeeIn("td[field-key='template']", $layout->template->template_name);
        });
    }

}
