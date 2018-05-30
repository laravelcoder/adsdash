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

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $template, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.templates.index'))
                ->clickLink('Add new')
                ->type("template_name", $template->template_name)
                ->type("content", $template->content)
                ->select('select[name="pages[]"]', $relations[0]->id)
                ->select('select[name="pages[]"]', $relations[1]->id)
                ->type("description", $template->description)
                ->press('Save')
                ->assertRouteIs('admin.templates.index')
                ->assertSeeIn("tr:last-child td[field-key='template_name']", $template->template_name)
                ->assertSeeIn("tr:last-child td[field-key='content']", $template->content)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:last-child", $relations[1]->title);
        });
    }

    public function testEditTemplate()
    {
        $admin = \App\User::find(1);
        $template = factory('App\Template')->create();
        $template2 = factory('App\Template')->make();

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $template, $template2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.templates.index'))
                ->click('tr[data-entry-id="' . $template->id . '"] .btn-info')
                ->type("template_name", $template2->template_name)
                ->type("content", $template2->content)
                ->select('select[name="pages[]"]', $relations[0]->id)
                ->select('select[name="pages[]"]', $relations[1]->id)
                ->type("description", $template2->description)
                ->press('Update')
                ->assertRouteIs('admin.templates.index')
                ->assertSeeIn("tr:last-child td[field-key='template_name']", $template2->template_name)
                ->assertSeeIn("tr:last-child td[field-key='content']", $template2->content)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:last-child", $relations[1]->title);
        });
    }

    public function testShowTemplate()
    {
        $admin = \App\User::find(1);
        $template = factory('App\Template')->create();

        $relations = [
            factory('App\Contentpage')->create(), 
            factory('App\Contentpage')->create(), 
        ];

        $template->pages()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $template, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.templates.index'))
                ->click('tr[data-entry-id="' . $template->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='template_name']", $template->template_name)
                ->assertSeeIn("td[field-key='content']", $template->content)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='pages'] span:last-child", $relations[1]->title)
                ->assertSeeIn("td[field-key='description']", $template->description);
        });
    }

}
