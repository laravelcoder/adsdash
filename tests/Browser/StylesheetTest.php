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

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $stylesheet, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.stylesheets.index'))
                ->clickLink('Add new')
                ->type("order", $stylesheet->order)
                ->type("link", $stylesheet->link)
                ->select('select[name="pages[]"]', $relations[0]->id)
                ->select('select[name="pages[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.stylesheets.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $stylesheet->order)
                ->assertSeeIn("tr:last-child td[field-key='link']", $stylesheet->link);
        });
    }

    public function testEditStylesheet()
    {
        $admin = \App\User::find(1);
        $stylesheet = factory('App\Stylesheet')->create();
        $stylesheet2 = factory('App\Stylesheet')->make();

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $stylesheet, $stylesheet2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.stylesheets.index'))
                ->click('tr[data-entry-id="' . $stylesheet->id . '"] .btn-info')
                ->type("order", $stylesheet2->order)
                ->type("link", $stylesheet2->link)
                ->select('select[name="pages[]"]', $relations[0]->id)
                ->select('select[name="pages[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.stylesheets.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $stylesheet2->order)
                ->assertSeeIn("tr:last-child td[field-key='link']", $stylesheet2->link);
        });
    }

    public function testShowStylesheet()
    {
        $admin = \App\User::find(1);
        $stylesheet = factory('App\Stylesheet')->create();

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $stylesheet->pages()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $stylesheet, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.stylesheets.index'))
                ->click('tr[data-entry-id="' . $stylesheet->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='order']", $stylesheet->order)
                ->assertSeeIn("td[field-key='link']", $stylesheet->link)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:last-child", $relations[1]->title);
        });
    }

}
