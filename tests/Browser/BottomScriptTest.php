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

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $bottom_script, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.bottom_scripts.index'))
                ->clickLink('Add new')
                ->type("script", $bottom_script->script)
                ->type("name", $bottom_script->name)
                ->check("jquery")
                ->select('select[name="pages[]"]', $relations[0]->id)
                ->select('select[name="pages[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.bottom_scripts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $bottom_script->name)
                ->assertChecked("jquery");
        });
    }

    public function testEditBottomScript()
    {
        $admin = \App\User::find(1);
        $bottom_script = factory('App\BottomScript')->create();
        $bottom_script2 = factory('App\BottomScript')->make();

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $bottom_script, $bottom_script2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.bottom_scripts.index'))
                ->click('tr[data-entry-id="' . $bottom_script->id . '"] .btn-info')
                ->type("script", $bottom_script2->script)
                ->type("name", $bottom_script2->name)
                ->check("jquery")
                ->select('select[name="pages[]"]', $relations[0]->id)
                ->select('select[name="pages[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.bottom_scripts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $bottom_script2->name)
                ->assertChecked("jquery");
        });
    }

    public function testShowBottomScript()
    {
        $admin = \App\User::find(1);
        $bottom_script = factory('App\BottomScript')->create();

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $bottom_script->pages()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $bottom_script, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.bottom_scripts.index'))
                ->click('tr[data-entry-id="' . $bottom_script->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='script']", $bottom_script->script)
                ->assertSeeIn("td[field-key='name']", $bottom_script->name)
                ->assertNotChecked("jquery")
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:last-child", $relations[1]->title);
        });
    }

}
