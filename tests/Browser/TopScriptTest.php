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

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $top_script, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.top_scripts.index'))
                ->clickLink('Add new')
                ->type("name", $top_script->name)
                ->type("script", $top_script->script)
                ->check("jquery")
                ->select('select[name="pages[]"]', $relations[0]->id)
                ->select('select[name="pages[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.top_scripts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $top_script->name)
                ->assertChecked("jquery");
        });
    }

    public function testEditTopScript()
    {
        $admin = \App\User::find(1);
        $top_script = factory('App\TopScript')->create();
        $top_script2 = factory('App\TopScript')->make();

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $top_script, $top_script2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.top_scripts.index'))
                ->click('tr[data-entry-id="' . $top_script->id . '"] .btn-info')
                ->type("name", $top_script2->name)
                ->type("script", $top_script2->script)
                ->check("jquery")
                ->select('select[name="pages[]"]', $relations[0]->id)
                ->select('select[name="pages[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.top_scripts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $top_script2->name)
                ->assertChecked("jquery");
        });
    }

    public function testShowTopScript()
    {
        $admin = \App\User::find(1);
        $top_script = factory('App\TopScript')->create();

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $top_script->pages()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $top_script, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.top_scripts.index'))
                ->click('tr[data-entry-id="' . $top_script->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $top_script->name)
                ->assertSeeIn("td[field-key='script']", $top_script->script)
                ->assertNotChecked("jquery")
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:last-child", $relations[1]->title);
        });
    }

}
