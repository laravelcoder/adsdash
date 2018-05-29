<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TopScriptTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateTopScript()
    {
        $admin = \App\User::find(1);
        $top_script = factory('App\TopScript')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $top_script) {
            $browser->loginAs($admin)
                ->visit(route('admin.top_scripts.index'))
                ->clickLink('Add new')
                ->type("name", $top_script->name)
                ->type("script", $top_script->script)
                ->uncheck("jquery")
                ->select("template_id", $top_script->template_id)
                ->press('Save')
                ->assertRouteIs('admin.top_scripts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $top_script->name)
                ->assertNotChecked("jquery")
                ->assertSeeIn("tr:last-child td[field-key='template']", $top_script->template->template_name);
        });
    }

    public function testEditTopScript()
    {
        $admin = \App\User::find(1);
        $top_script = factory('App\TopScript')->create();
        $top_script2 = factory('App\TopScript')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $top_script, $top_script2) {
            $browser->loginAs($admin)
                ->visit(route('admin.top_scripts.index'))
                ->click('tr[data-entry-id="' . $top_script->id . '"] .btn-info')
                ->type("name", $top_script2->name)
                ->type("script", $top_script2->script)
                ->uncheck("jquery")
                ->select("template_id", $top_script2->template_id)
                ->press('Update')
                ->assertRouteIs('admin.top_scripts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $top_script2->name)
                ->assertNotChecked("jquery")
                ->assertSeeIn("tr:last-child td[field-key='template']", $top_script2->template->template_name);
        });
    }

    public function testShowTopScript()
    {
        $admin = \App\User::find(1);
        $top_script = factory('App\TopScript')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $top_script) {
            $browser->loginAs($admin)
                ->visit(route('admin.top_scripts.index'))
                ->click('tr[data-entry-id="' . $top_script->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $top_script->name)
                ->assertSeeIn("td[field-key='script']", $top_script->script)
                ->assertChecked("jquery")
                ->assertSeeIn("td[field-key='template']", $top_script->template->template_name);
        });
    }

}
