<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class BottomScriptTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateBottomScript()
    {
        $admin = \App\User::find(1);
        $bottom_script = factory('App\BottomScript')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $bottom_script) {
            $browser->loginAs($admin)
                ->visit(route('admin.bottom_scripts.index'))
                ->clickLink('Add new')
                ->type("script", $bottom_script->script)
                ->type("name", $bottom_script->name)
                ->check("jquery")
                ->select("template_id", $bottom_script->template_id)
                ->press('Save')
                ->assertRouteIs('admin.bottom_scripts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $bottom_script->name)
                ->assertSeeIn("tr:last-child td[field-key='template']", $bottom_script->template->template_name);
        });
    }

    public function testEditBottomScript()
    {
        $admin = \App\User::find(1);
        $bottom_script = factory('App\BottomScript')->create();
        $bottom_script2 = factory('App\BottomScript')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $bottom_script, $bottom_script2) {
            $browser->loginAs($admin)
                ->visit(route('admin.bottom_scripts.index'))
                ->click('tr[data-entry-id="' . $bottom_script->id . '"] .btn-info')
                ->type("script", $bottom_script2->script)
                ->type("name", $bottom_script2->name)
                ->check("jquery")
                ->select("template_id", $bottom_script2->template_id)
                ->press('Update')
                ->assertRouteIs('admin.bottom_scripts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $bottom_script2->name)
                ->assertSeeIn("tr:last-child td[field-key='template']", $bottom_script2->template->template_name);
        });
    }

    public function testShowBottomScript()
    {
        $admin = \App\User::find(1);
        $bottom_script = factory('App\BottomScript')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $bottom_script) {
            $browser->loginAs($admin)
                ->visit(route('admin.bottom_scripts.index'))
                ->click('tr[data-entry-id="' . $bottom_script->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='script']", $bottom_script->script)
                ->assertSeeIn("td[field-key='name']", $bottom_script->name)
                ->assertNotChecked("jquery")
                ->assertSeeIn("td[field-key='template']", $bottom_script->template->template_name)
                ->assertSeeIn("td[field-key='created_by']", $bottom_script->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $bottom_script->created_by_team->name);
        });
    }

}
